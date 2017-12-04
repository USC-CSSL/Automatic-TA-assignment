/**
 * 
 */
package ta.course.assignment;

import static java.util.Comparator.comparingInt;
import static java.util.stream.Collectors.toMap;

import java.io.BufferedWriter;
import java.io.File;
import java.io.FileOutputStream;
import java.io.IOException;
import java.io.OutputStreamWriter;
import java.util.ArrayList;
import java.util.Collections;
import java.util.Comparator;
import java.util.HashMap;
import java.util.HashSet;
import java.util.LinkedHashMap;
import java.util.List;
import java.util.Map;
import java.util.Set;
//import com.mysql.jdbc.Driver;
import java.util.stream.Collectors;

import ta.course.assignment.dao.CourseDAO;
import ta.course.assignment.dao.CourseSectionDAO;
import ta.course.assignment.dao.MatchingDAO;
import ta.course.assignment.dao.MilestoneDAO;
import ta.course.assignment.dao.TADAO;
import ta.course.assignment.dao.TAPreferencesDAO;
import ta.course.assignment.dao.TATimeConstraintsDAO;
import ta.course.assignment.dao.TimeIntervalsDAO;
import ta.course.assignment.dao.UserDAO;

/**
 * @author rajdeepkaur
 *
 */
public class GenerateAssignment {

	/**
	 * @param args
	 */
	
	List<User> users = new ArrayList<User>();
	Map<Integer,User> userMap = new HashMap<Integer,User>();
	
	List<Course> courses = new ArrayList<Course>();
	Map<Integer,Course> coursesMap = new HashMap<Integer,Course>();
	
	List<CourseSection> courseSections = new ArrayList<CourseSection>();
	Map<Integer,CourseSection> courseSectionMap = new HashMap<Integer,CourseSection>();
	
	List<TA> tas = new ArrayList<TA>();
	public Map<Integer,TA> tasMap = new HashMap<Integer,TA>();
	
	List<TAPreferences> taPreferences =  new ArrayList<TAPreferences>();
	Map<Integer,TAPreferences> taPreferencesMap = new HashMap<Integer,TAPreferences>();
	
	List<TATimeConstraints> taTimeConstraints =  new ArrayList<TATimeConstraints>();
	Map<Integer,TATimeConstraints> taTimeConstraintsMap = new HashMap<Integer,TATimeConstraints>();
	
	List<TimeIntervals> timeIntervals = new ArrayList<TimeIntervals>();
	Map<Integer,TimeIntervals> timeIntervalsMap = new HashMap<Integer,TimeIntervals>();
	
	List<Milestone> milestones = new ArrayList<Milestone>();
	Map<Integer,Milestone> milestonesMap = new HashMap<Integer,Milestone>();
	
	Map<String,List<Integer>> lectureToLabMap = new HashMap<String,List<Integer>>();
	
	//map to check if this ta is already assigned to the sections
	Map<Integer,Integer> tADone = new HashMap<Integer,Integer>();
	
	//map to store the actual mapping
	Map<Integer,Integer> finalSectionToTAAssignment = new HashMap<Integer,Integer>();
	
	Map<Integer,Integer> courseSectionDone = new HashMap<Integer,Integer>();
	
	//Function to find eligible TA based on time conflicts of TA and sections
	Map<Integer,List<TAPreferences>> findEligibleMatches (List<TAPreferences> orderedTaPreferences) {
		//map to store the lecture code and list of eligible TA for it.
		Map<String,List<TAPreferences>> eligilbeTAForCourseLecture = new HashMap<String,List<TAPreferences>>();
		
		//map to store eligible TA for each lab section
		Map<Integer,List<TAPreferences>> eligilbeTAForSection = new HashMap<Integer,List<TAPreferences>>();
		
		Map<Integer,List<TAPreferences>> eligilbeTAForSectionSorted = new HashMap<Integer,List<TAPreferences>>();
		
		for (TAPreferences taPreference: orderedTaPreferences) {
			Course course = this.coursesMap.get(taPreference.getCourseId());
			List<TATimeConstraints> taTimeConflicts = this.taTimeConstraints.stream().filter(e -> e.getTaId() == taPreference.getTaId()).collect(Collectors.toList());
			//intervel when TA is not present
			List<Integer> conflictIds = new ArrayList<Integer>();
			for (TATimeConstraints timeConflict : taTimeConflicts) {
				conflictIds.add(timeConflict.getTimeInteravalNotAvilableId());
			}
			
			List<CourseSection> courseLectures = this.courseSections.stream().filter(e -> (e.getCourseId() == taPreference.getCourseId() && e.isLecture())).collect(Collectors.toList());
			/*
			List<Integer> courseTimeIds = new ArrayList<Integer>();
			for (CourseSection courseTime : courseTimings) {
				courseTimeIds.add(courseTime.getTimeSlotId());
			}
			
			courseTimeIds.removeAll(conflictIds);*/
			for (CourseSection lecture : courseLectures) {
				if (!conflictIds.contains(lecture.getTimeSlotId())) {
					if (eligilbeTAForCourseLecture.containsKey(lecture.getLectureCode())) {
						List<TAPreferences> temp = eligilbeTAForCourseLecture.get(lecture.getLectureCode());
						temp.add(taPreference);
						eligilbeTAForCourseLecture.put(lecture.getLectureCode(), temp);
					} else {
						List<TAPreferences> temp = new ArrayList<TAPreferences>();
						temp.add(taPreference);
						eligilbeTAForCourseLecture.put(lecture.getLectureCode(), temp);
					}
				}
			}
		}
		//get eligible ta for each section
		for (String keys : eligilbeTAForCourseLecture.keySet()) {
			List<TAPreferences> vals = eligilbeTAForCourseLecture.get(keys);
			for (TAPreferences taPreference :vals) {
				
				//conflciting time for this TA
				List<TATimeConstraints> timeConflicts = this.taTimeConstraints.stream().filter(e -> e.getTaId() == taPreference.getTaId()).collect(Collectors.toList());
				List<Integer> conflictIds = new ArrayList<Integer>();
				for (TATimeConstraints timeConflict : timeConflicts) {
					conflictIds.add(timeConflict.getTimeInteravalNotAvilableId());
				}
				
				//System.out.println("keys " + keys + " taiD : " + taPreference.getTaId());
				for (CourseSection cs : this.courseSections) {
					if ((cs.getLectureCode().equals(keys) && !cs.isLecture()) || !this.lectureToLabMap.containsKey(cs.getLectureCode())) {
						if (!conflictIds.contains(cs.getTimeSlotId())) {
							if (eligilbeTAForSection.containsKey(cs.getSectionId())) {
								List<TAPreferences> temp = eligilbeTAForSection.get(cs.getSectionId());
								temp.add(taPreference);
								eligilbeTAForSection.put(cs.getSectionId(), temp);
							} else {
								List<TAPreferences> temp = new ArrayList<TAPreferences>();
								temp.add(taPreference);
								eligilbeTAForSection.put(cs.getSectionId(), temp);
							}
						}
					} 
				}
				
			}
		}
		for (Integer section : eligilbeTAForSection.keySet()) {
			List<TAPreferences> vals = eligilbeTAForSection.get(section);
			Collections.sort(vals, new Comparator<TAPreferences>() {
			    public int compare(TAPreferences s1, TAPreferences s2) {
			        return (((Float)s2.getScore()).compareTo((Float)s1.getScore()));
			    }
			});
			List<TAPreferences> happy = new ArrayList<TAPreferences>();
			List<TAPreferences> unhappy = new ArrayList<TAPreferences>();
			for (int i = 0;i < vals.size(); i++) {
				TAPreferences temp = vals.get(i);
				if (this.tasMap.get(temp.getTaId()).getCourseTaughtLastSemester() == temp.getCourseId()) {
					if (this.tasMap.get(temp.getTaId()).getHappyWithLastCourseTaught()) {
						happy.add(temp);
					} else unhappy.add(temp);
				} else {
					happy.add(temp);
				}
			}
			happy.addAll(unhappy);
			eligilbeTAForSectionSorted.put(section, happy);		
		}		
		return eligilbeTAForSection;
	}
	
	void distributeTA (Map<Integer,List<TAPreferences>> tAPreferences1) {
		Map<Integer, List<TAPreferences>> sorted = tAPreferences1.entrySet().stream()
		        .sorted(comparingInt(e->e.getValue().size()))
		        .collect(toMap(
		                Map.Entry::getKey,
		                Map.Entry::getValue,
		                (a,b) -> {throw new AssertionError();},
		                LinkedHashMap::new
		        )); 
		
		
		for (Integer section : sorted.keySet()) {
			List<TAPreferences> taPreferenceList = sorted.get(section);
			for (TAPreferences taP : taPreferenceList) {
				if (!this.tADone.containsKey(taP.getTaId()) && !this.courseSectionDone.containsKey(section)) {
					List<Integer> sectionForSameLecture = this.lectureToLabMap.get(this.courseSectionMap.get(section).getLectureCode());
					for (int i = 0; i< sectionForSameLecture.size();i++) {
						if (sectionForSameLecture.get(i) != section) {
							List<TAPreferences> taPreferenceListForAnotherSection = null;
							
							if (sorted.get(sectionForSameLecture.get(i)) != null)
							taPreferenceListForAnotherSection = sorted.get(sectionForSameLecture.get(i)).stream().filter(item -> item.getTaId() == taP.getTaId()).collect(Collectors.toList());
							
							if (taPreferenceListForAnotherSection != null && !taPreferenceListForAnotherSection.isEmpty() && !this.courseSectionDone.containsKey(sectionForSameLecture.get(i))) {
								this.tADone.put(taP.getTaId(),1);
								this.courseSectionDone.put(section,1);
								this.courseSectionDone.put(sectionForSameLecture.get(i),1);
								this.finalSectionToTAAssignment.put(section, taP.getTaId());
								this.finalSectionToTAAssignment.put(sectionForSameLecture.get(i), taP.getTaId());
								break;
							}
						}
					}
					if (sectionForSameLecture.isEmpty()) {
						this.tADone.put(taP.getTaId(),1);
						this.courseSectionDone.put(section,1);
						this.finalSectionToTAAssignment.put(section, taP.getTaId());
					}
				}
			}
		}
	}
	
	void runAlgorithm () {
		Set<String> finalOutput = new HashSet<String>();
		
		List<TAPreferences> fiveInterest = this.taPreferences.stream().filter(e -> e.getInterestLevel() == 5).collect(Collectors.toList());
		List<TAPreferences> fourInterest = this.taPreferences.stream().filter(e -> e.getInterestLevel() == 4).collect(Collectors.toList());
		List<TAPreferences> threeInterest = this.taPreferences.stream().filter(e -> e.getInterestLevel() == 3).collect(Collectors.toList());
		List<TAPreferences> twoInterest = this.taPreferences.stream().filter(e -> e.getInterestLevel() == 2).collect(Collectors.toList());
		List<TAPreferences> oneInterest = this.taPreferences.stream().filter(e -> e.getInterestLevel() == 1).collect(Collectors.toList());
		
		Map<Integer,List<TAPreferences>> tAPreferencesForFive = this.findEligibleMatches(fiveInterest);
		Map<Integer,List<TAPreferences>> tAPreferencesForFour = this.findEligibleMatches(fourInterest);	
		Map<Integer,List<TAPreferences>> tAPreferencesForThree = this.findEligibleMatches(threeInterest);
		Map<Integer,List<TAPreferences>> tAPreferencesForTwo = this.findEligibleMatches(twoInterest);
		Map<Integer,List<TAPreferences>> tAPreferencesForOne = this.findEligibleMatches(oneInterest);
		
		this.distributeTA(tAPreferencesForFive);
		this.distributeTA(tAPreferencesForFour);
		this.distributeTA(tAPreferencesForThree);
		this.distributeTA(tAPreferencesForTwo);
		this.distributeTA(tAPreferencesForOne);		
		/*
		Set<Integer> sectionsSet = tAPreferencesForFive.keySet();
		List<Integer> sectionList = new ArrayList<Integer>();
		sectionList.addAll(sectionsSet);
		for (int i = 0;i< sectionList.size();i++) {
			for (int j = 0; j< sectionList.size();j++) {
				List<TAPreferences> vals = eligilbeTAForSectionHigh.get(sectionList.get(j));
				for (TAPreferences taPreference :vals) {
					if (this.tasMap.get(taPreference.getTaId()).getArea() != null || !this.tasMap.get(taPreference.getTaId()).getArea().equals("") && this.tasMap.get(taPreference.getTaId()).getArea().equals("Quant")) {
						if (this.coursesMap.get(taPreference.getCourseId()).getArea() == null || "".equals(this.coursesMap.get(taPreference.getCourseId()).getArea())) {
							continue;
						}
						if (!this.tasMap.get(taPreference.getTaId()).getArea().equals(this.coursesMap.get(taPreference.getCourseId()).getArea())) {
							continue;
						}
					}
					if (!tADone.containsKey(taPreference.getTaId()) && !courseSectionDone.containsKey(sectionList.get(j))) {
						System.out.println("Section Id " + sectionList.get(0) + " Possible TaiD : " + taPreference.getTaId() + "Score" + taPreference.getScore());
						courseSectionDone.put(sectionList.get(j),1);
						tADone.put(taPreference.getTaId(), 1);
						finalSectionToTAAssignment.put(sectionList.get(j), taPreference.getTaId());
						break;
					}
				}
			}

				

			}
			System.out.println("\nDONE WITH ASSIGNMENT\n");
			StringBuilder sb = new StringBuilder();

			for (Integer key : finalSectionToTAAssignment.keySet()) {
				sb.append(finalSectionToTAAssignment.get(key)).append(",").append(key).append("\n");
				System.out.println("TA : "+ finalSectionToTAAssignment.get(key) + " Section Id : " + key + " ");
			}
			finalOutput.add(sb.toString());
			System.out.println(sb.toString());
			finalSectionToTAAssignment.clear();
			courseSectionDone.clear();
			tADone.clear();
			
			Integer temp = sectionList.get(0);
			sectionList.remove(0);
			sectionList.add(temp);
		}
		
		
		try {
			PrintWriter pw = new PrintWriter(new File("matching.csv"));
			Iterator<String> itr = finalOutput.iterator();
			while (itr.hasNext()) {
				pw.print(itr.next());
				pw.println();
			}
	        pw.close();
	        System.out.println("done!");
		} catch (FileNotFoundException e1) {
			// TODO Auto-generated catch block
			e1.printStackTrace();
		}*/
		
	}
	
	private void enrichTA (List<TA> tas) {
		for (TA ta : tas) {
			String[] milestones = ta.getMilestoneId().replaceAll("\\s","").split(",");
			float totalScore = 0;
			for (String mileStoneId : milestones) {
				if (!mileStoneId.equals(""))
				totalScore = totalScore + Float.parseFloat(this.milestonesMap.get(Integer.parseInt(mileStoneId)).getScore());
			}
			ta.setScore(totalScore);
			ta.setScore(ta.getScore() +(float) (0.2)*ta.getHasTAExperianceForNumberOfSemester());
		}
	}
	
	public static void main(String[] args) {
		UserDAO userDAO = new UserDAO(MyBatisConnectionFactory.getSqlSessionFactory());
		CourseDAO courseDAO = new CourseDAO(MyBatisConnectionFactory.getSqlSessionFactory());
		CourseSectionDAO courseSectionDAO = new CourseSectionDAO(MyBatisConnectionFactory.getSqlSessionFactory());
		TADAO taDAO = new TADAO(MyBatisConnectionFactory.getSqlSessionFactory());
		TAPreferencesDAO taPreferencesDAO = new TAPreferencesDAO(MyBatisConnectionFactory.getSqlSessionFactory());
		TATimeConstraintsDAO taTimeConstraintsDAO = new TATimeConstraintsDAO(MyBatisConnectionFactory.getSqlSessionFactory());
		TimeIntervalsDAO timeIntervalsDAO = new TimeIntervalsDAO(MyBatisConnectionFactory.getSqlSessionFactory());
		MilestoneDAO milestoneDAO = new MilestoneDAO(MyBatisConnectionFactory.getSqlSessionFactory());
		MatchingDAO matchingDAO = new MatchingDAO(MyBatisConnectionFactory.getSqlSessionFactory());
		
		GenerateAssignment gs = new GenerateAssignment();
		
		List<Matching> adminMatching = matchingDAO.getAdminMatching();
		Map<Integer,Integer> adminMatchingMap = new HashMap<Integer,Integer>();
		for (Matching amatch : adminMatching) {
			adminMatchingMap.put(amatch.getSectionId(), amatch.getTaId());
			gs.tADone.put(amatch.getTaId(),1);
			gs.courseSectionDone.put(amatch.getSectionId(), 1);
		}
		
		for (Matching fixedMatching : adminMatching) {
			gs.finalSectionToTAAssignment.put(fixedMatching.getSectionId(), fixedMatching.getTaId());
		}
		//System.out.println("\n*** Milestones *** ");
		gs.milestones = milestoneDAO.selectAll();
		for (Milestone ms : gs.milestones) {
			gs.milestonesMap.put(ms.getMilestoneId(), ms);
		}
		//gs.milestonesMap = gs.milestones.stream().distinct().collect(Collectors.toMap(Milestone::getMilestoneId, item-> item));
		
		System.out.println("*** Users *** ");
		gs.users = userDAO.selectAll();
		//gs.userMap = gs.users.stream().distinct().collect(Collectors.toMap(User::getUserId, item-> item));
		System.out.println("Username" + " "+ "UserId");
		for (User user: gs.users) {
			gs.userMap.put(user.getUserId(), user);
		}
		
		System.out.println("\n*** Courses *** ");
		gs.courses = courseDAO.selectAll();
		//gs.coursesMap = gs.courses.stream().distinct().collect(Collectors.toMap(Course::getCourseId, item-> item));
		for (Course course: gs.courses) {
			gs.coursesMap.put(course.getCourseId(),course);
			System.out.println("course id : "+ course.getCourseId() + " Area " + course.getArea() );
		}
		
		System.out.println("\n*** Course Section *** ");
		//System.out.println(" SectionId" + " "+ "Course Id" + " "+ "Time Slot" );
		gs.courseSections = courseSectionDAO.selectAll();
		//gs.courseSectionMap = gs.courseSections.stream().distinct().collect(Collectors.toMap(CourseSection::getSectionId, item-> item));
		//Set<CourseSection> lectures = gs.courseSections.stream().filter(item -> item.isLecture()).collect(Collectors.toSet());
		for (CourseSection cs : gs.courseSections) {
			gs.courseSectionMap.put(cs.getSectionId(), cs);
		}
		
		for (CourseSection courseSection: gs.courseSections) {
			if (gs.lectureToLabMap.containsKey(courseSection.getLectureCode()) && !courseSection.isLecture()) {
				List<Integer> labs = gs.lectureToLabMap.get(courseSection.getLectureCode());
				labs.add(courseSection.getSectionId());
				gs.lectureToLabMap.put(courseSection.getLectureCode(), labs);
			} else if (courseSection.isLecture()){
				List<Integer> labs = new ArrayList<Integer>();
				labs.add(courseSection.getSectionId());
				gs.lectureToLabMap.put(courseSection.getLectureCode(), labs);
			}
		System.out.println(courseSection.getSectionId()+"            "+courseSection.getCourseId() + "            "+ courseSection.getTimeSlotId());
		}
		
		System.out.println("\n*** TA *** ");
		gs.tas = taDAO.selectAll();
		gs.enrichTA(gs.tas);
		//gs.tasMap = gs.tas.stream().distinct().collect(Collectors.toMap(TA::getTaId, item-> item));
		System.out.println(" TAId" + " "+ "Area" + " Has_TA_Experiance");
		for (TA ta: gs.tas) {
			gs.tasMap.put(ta.getTaId(), ta);
		    System.out.println(ta.getTaId()+"      "+ta.getArea() + "      "+ ta.getHasTAExperience());
		}
		
		System.out.println("\n*** TA Preferences *** ");
		gs.taPreferences = taPreferencesDAO.selectAll();
		for (TAPreferences taPreference: gs.taPreferences) {
			System.out.println(taPreference.getTaId() + " "+ taPreference.getCourseId()+" "+
					taPreference.getInterestLevel());
			taPreference.setScore(gs.tasMap.get(taPreference.getTaId()).getScore());
			int courseTaughtLastSemester = gs.tasMap.get(taPreference.getTaId()).getCourseTaughtLastSemester();
			if (courseTaughtLastSemester == taPreference.getCourseId() && gs.tasMap.get(taPreference.getTaId()).getHappyWithLastCourseTaught()) {
				taPreference.setScore((float)(0.2 + gs.tasMap.get(taPreference.getTaId()).getScore()));			
			}
			System.out.println("ta map size "+ gs.tasMap.size());
			System.out.println("course map size "+ gs.coursesMap.size());
			if (gs.coursesMap.get(taPreference.getCourseId()).getArea() !=null && "Quant".equals(gs.coursesMap.get(taPreference.getCourseId()).getArea()) && gs.tasMap.get(taPreference.getTaId()).getArea() != null && "Quant".equals(gs.tasMap.get(taPreference.getTaId()).getArea())) {
				taPreference.setScore((float)(5 + gs.tasMap.get(taPreference.getTaId()).getScore()));			
			}
			gs.taPreferencesMap.put(taPreference.getId(), taPreference);
		}
		//gs.taPreferencesMap = gs.taPreferences.stream().distinct().collect(Collectors.toMap(TAPreferences::getId, item-> item));
		
		
		System.out.println("\n*** TA Time Constraints *** ");
		gs.taTimeConstraints = taTimeConstraintsDAO.selectAll();
		//gs.taTimeConstraintsMap = gs.taTimeConstraints.stream().distinct().collect(Collectors.toMap(TATimeConstraints::getConstraintsId, item-> item));
		for (TATimeConstraints taTimeConstraint: gs.taTimeConstraints) {
			gs.taTimeConstraintsMap.put(taTimeConstraint.getConstraintsId(), taTimeConstraint);
		System.out.println(taTimeConstraint.getTaId() + " "+ taTimeConstraint.getConstraintsId()+" "+
				taTimeConstraint.getTimeInteravalNotAvilableId());
		}
		
		System.out.println("\n*** Time Intervals *** ");
		gs.timeIntervals = timeIntervalsDAO.selectAll();
		//gs.taTimeConstraintsMap = gs.taTimeConstraints.stream().distinct().collect(Collectors.toMap(TATimeConstraints::getConstraintsId, item-> item));
		for (TimeIntervals timeInterval: gs.timeIntervals) {
			gs.timeIntervalsMap.put(timeInterval.getTimeSlotId(), timeInterval);
		System.out.println(timeInterval.getTimeSlotId() + " "+ timeInterval.getDay() + " "+ timeInterval.getStartTime() + " - " + timeInterval.getEndTime());
		}

		//run algorithm on data
		gs.runAlgorithm();
		Matching lastRun = matchingDAO.getRunId();
		int runId = 1;
		if (lastRun != null) {
			runId = lastRun.getRunId()+1;
		}
		for (Integer section : gs.finalSectionToTAAssignment.keySet()) {
			if (!(adminMatchingMap.containsKey(section) && adminMatchingMap.get(section) == gs.finalSectionToTAAssignment.get(section)) ) {
				HashMap<String, Integer> hm = new HashMap<String, Integer>();
				hm.put("Section_Id", section);
				hm.put("TA_Id", gs.finalSectionToTAAssignment.get(section));
				hm.put("Run_Id", runId);
				matchingDAO.insertMatching(hm);
			}
			System.out.println("SectionId :  "+ section + "- TA :  " + gs.finalSectionToTAAssignment.get(section));
		}
		File file = new File("output.txt");
		if (file.exists()) {
			file.delete(); // you might want to check if delete was
							// successfull
		}
		try {
			file.createNewFile();
			FileOutputStream fileOutput = new FileOutputStream(file);
			BufferedWriter bw = new BufferedWriter(new OutputStreamWriter(
					fileOutput));
			bw.write("HELLOOOOO");
			bw.flush();
			bw.close();
		} catch (IOException e) {
			// TODO Auto-generated catch block
			e.printStackTrace();
		}

		System.out.println("sized matching "+ matchingDAO.getMatching().size());
	}

}

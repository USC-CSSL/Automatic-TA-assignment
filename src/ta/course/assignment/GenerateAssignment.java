/**
 * 
 */
package ta.course.assignment;

import java.util.ArrayList;
import java.util.Arrays;
import java.util.Collections;
import java.util.Comparator;
import java.util.HashMap;
import java.util.List;
import java.util.Map;
//import com.mysql.jdbc.Driver;
import java.util.stream.Collectors;

import ta.course.assignment.dao.CourseDAO;
import ta.course.assignment.dao.CourseSectionDAO;
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
	
	Map<Integer,List<TAPreferences>> findEligibleMatches (List<TAPreferences> orderedTaPreferences) {
		Map<Integer,List<TAPreferences>> eligilbeTAForCourse = new HashMap<Integer,List<TAPreferences>>();
		for (TAPreferences taPreference: orderedTaPreferences) {
			Course course = this.coursesMap.get(taPreference.getCourseId());
			List<TATimeConstraints> timeConflicts = this.taTimeConstraints.stream().filter(e -> e.getTaId() == taPreference.getTaId()).collect(Collectors.toList());
			//if (timeConflicts.contains(course.g
			List<Integer> conflictIds = new ArrayList<Integer>();
			for (TATimeConstraints timeConflict : timeConflicts) {
				conflictIds.add(timeConflict.getTimeInteravalNotAvilableId());
			}
			
			List<CourseSection> courseTimings = this.courseSections.stream().filter(e -> (e.getCourseId() == taPreference.getCourseId() && e.isLecture())).collect(Collectors.toList());
			List<Integer> courseTimeIds = new ArrayList<Integer>();
			for (CourseSection courseTime : courseTimings) {
				courseTimeIds.add(courseTime.getTimeSlotId());
			}
			
			courseTimeIds.removeAll(conflictIds);
			if (!courseTimeIds.isEmpty())
			{
				if (eligilbeTAForCourse.containsKey(course.getCourseId())) {
					List<TAPreferences> temp = eligilbeTAForCourse.get(course
							.getCourseId());
					temp.add(taPreference);
					eligilbeTAForCourse.put(course.getCourseId(), temp);
				} else {
					List<TAPreferences> temp = new ArrayList<TAPreferences>();
					temp.add(taPreference);
					eligilbeTAForCourse.put(course.getCourseId(), temp);
				}
			}
		}
		
		//get eligible ta for each section
		Map<Integer,List<TAPreferences>> eligilbeTAForSection = new HashMap<Integer,List<TAPreferences>>();
		for (Integer keys : eligilbeTAForCourse.keySet()) {
			List<TAPreferences> vals = eligilbeTAForCourse.get(keys);
			for (TAPreferences taPreference :vals) {
				
				//conflciting time for this TA
				List<TATimeConstraints> timeConflicts = this.taTimeConstraints.stream().filter(e -> e.getTaId() == taPreference.getTaId()).collect(Collectors.toList());
				List<Integer> conflictIds = new ArrayList<Integer>();
				for (TATimeConstraints timeConflict : timeConflicts) {
					conflictIds.add(timeConflict.getTimeInteravalNotAvilableId());
				}
				
				//System.out.println("keys " + keys + " taiD : " + taPreference.getTaId());
				for (CourseSection cs : this.courseSections) {
					if (cs.getCourseId() == keys && !cs.isLecture()) {
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
		return eligilbeTAForSection;
	}
	
	
	void runAlgorithm () {
		Map<Integer,Integer> courseSectionDone = new HashMap<Integer,Integer>();
		Map<Integer,Integer> tADone = new HashMap<Integer,Integer>();
		Map<Integer,Integer> finalSectionToTAAssignment = new HashMap<Integer,Integer>();
		
		List<TAPreferences> highestPrefered = this.taPreferences.stream().filter(e -> e.getInterestLevel() == 3).collect(Collectors.toList());
		List<TAPreferences> mediumPrefered = this.taPreferences.stream().filter(e -> e.getInterestLevel() == 2).collect(Collectors.toList());
		List<TAPreferences> lowestPrefered = this.taPreferences.stream().filter(e -> e.getInterestLevel() == 1).collect(Collectors.toList());
		
		Map<Integer,List<TAPreferences>> eligilbeTAForSection = this.findEligibleMatches(highestPrefered);
		System.out.println("\nFINAL LIST FOR HIGHEST PREFERRED");
		
		for (Integer keys : eligilbeTAForSection.keySet()) {
			List<TAPreferences> vals = eligilbeTAForSection.get(keys);
			Collections.sort(vals, new Comparator<TAPreferences>() {
			    public int compare(TAPreferences s1, TAPreferences s2) {
			        return (((Float)s2.getScore()).compareTo((Float)s1.getScore()));
			    }
			});
			for (TAPreferences taPreference :vals) {
				System.out.println("Section Id " + keys + " Possible TaiD : " + taPreference.getTaId() + "Score" + taPreference.getScore());
			}
			for (TAPreferences taPreference :vals) {
				if (!tADone.containsKey(taPreference.getTaId()) && !courseSectionDone.containsKey(keys)) {
					System.out.println("Section Id " + keys + " Possible TaiD : " + taPreference.getTaId() + "Score" + taPreference.getScore());
					courseSectionDone.put(keys,1);
					tADone.put(taPreference.getTaId(), 1);
					finalSectionToTAAssignment.put(keys, taPreference.getTaId());
					break;
				}
			}
		}

		eligilbeTAForSection = this.findEligibleMatches(mediumPrefered);
		System.out.println("\nFINAL LIST FOR MEDIUM PREFERRED");
		for (Integer keys : eligilbeTAForSection.keySet()) {
			List<TAPreferences> vals = eligilbeTAForSection.get(keys);
			Collections.sort(vals, new Comparator<TAPreferences>() {
			    public int compare(TAPreferences s1, TAPreferences s2) {
			        return (((Float)s2.getScore()).compareTo((Float)s1.getScore()));
			    }
			});
			for (TAPreferences taPreference :vals) {
				System.out.println("Section Id " + keys + " Possible TaiD : " + taPreference.getTaId());
			}
			for (TAPreferences taPreference :vals) {
				if (!tADone.containsKey(taPreference.getTaId()) && !courseSectionDone.containsKey(keys)) {
					System.out.println("Section Id " + keys + " Possible TaiD : " + taPreference.getTaId() + "Score" + taPreference.getScore());
					courseSectionDone.put(keys,1);
					tADone.put(taPreference.getTaId(), 1);
					finalSectionToTAAssignment.put(keys, taPreference.getTaId());
					break;
				}
			}
		}
		
		eligilbeTAForSection = this.findEligibleMatches(lowestPrefered);
		System.out.println("\nFINAL LIST FOR LOWEST PREFERRED");
		for (Integer keys : eligilbeTAForSection.keySet()) {
			List<TAPreferences> vals = eligilbeTAForSection.get(keys);
			Collections.sort(vals, new Comparator<TAPreferences>() {
			    public int compare(TAPreferences s1, TAPreferences s2) {
			        return (((Float)s2.getScore()).compareTo((Float)s1.getScore()));
			    }
			});
			for (TAPreferences taPreference :vals) {
				System.out.println("Section Id " + keys + " Possible TaiD : " + taPreference.getTaId());
			}
			for (TAPreferences taPreference :vals) {
				if (!tADone.containsKey(taPreference.getTaId()) && !courseSectionDone.containsKey(keys)) {
					System.out.println("Section Id " + keys + " Possible TaiD : " + taPreference.getTaId() + "Score" + taPreference.getScore());
					courseSectionDone.put(keys,1);
					tADone.put(taPreference.getTaId(), 1);
					finalSectionToTAAssignment.put(keys, taPreference.getTaId());
					break;
				}
			}
		}
		
		System.out.println("\nDONE WITH ASSIGNMENT\n");
		for (Integer key : finalSectionToTAAssignment.keySet()) {
			System.out.println("Section Id : " + key + " "+ "TA : "+ finalSectionToTAAssignment.get(key));
		}
	}
	
	private void enrichTA (List<TA> tas) {
		for (TA ta : tas) {
			ta.setScore(this.milestonesMap.get(ta.getMilestoneId()).getScore());
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
		GenerateAssignment gs = new GenerateAssignment();
		
		System.out.println("\n*** Milestones *** ");
		gs.milestones = milestoneDAO.selectAll();
		gs.milestonesMap = gs.milestones.stream().collect(Collectors.toMap(Milestone::getMilestoneId, item-> item));
		for (Milestone mstone: gs.milestones) {
		System.out.println(mstone.getMilestoneId() + " "+ mstone.getMilestoneName() + " "+ mstone.getScore());
		}
		
		System.out.println("*** Users *** ");
		gs.users = userDAO.selectAll();
		gs.userMap = gs.users.stream().collect(Collectors.toMap(User::getUserId, item-> item));
		System.out.println("Username" + " "+ "UserId");
		for (User user: gs.users) {
		System.out.println(user.getName() + " "+ user.getUserId());
		}
		
		System.out.println("\n*** Courses *** ");
		System.out.println("CourseId" + " "+ "Course");
		gs.courses = courseDAO.selectAll();
		gs.coursesMap = gs.courses.stream().collect(Collectors.toMap(Course::getCourseId, item-> item));
		for (Course course: gs.courses) {
		System.out.println(course.getCourseId() + "         "+ course.getArea());
		}
		
		System.out.println("\n*** Course Section *** ");
		System.out.println(" SectionId" + " "+ "Course Id" + " "+ "Time Slot" );
		gs.courseSections = courseSectionDAO.selectAll();
		gs.courseSectionMap = gs.courseSections.stream().collect(Collectors.toMap(CourseSection::getSectionId, item-> item));
		for (CourseSection courseSection: gs.courseSections) {
		System.out.println(courseSection.getSectionId()+"            "+courseSection.getCourseId() + "            "+ courseSection.getTimeSlotId());
		}
		
		System.out.println("\n*** TA *** ");
		gs.tas = taDAO.selectAll();
		gs.enrichTA(gs.tas);
		gs.tasMap = gs.tas.stream().collect(Collectors.toMap(TA::getTaId, item-> item));
		System.out.println(" TAId" + " "+ "Area" + " Has_TA_Experiance");
		for (TA ta: gs.tas) {
		System.out.println(ta.getTaId()+"      "+ta.getArea() + "      "+ ta.getHasTAExperience());
		}
		
		System.out.println("\n*** TA Preferences *** ");
		gs.taPreferences = taPreferencesDAO.selectAll();
		gs.taPreferencesMap = gs.taPreferences.stream().collect(Collectors.toMap(TAPreferences::getId, item-> item));
		for (TAPreferences taPreference: gs.taPreferences) {
			taPreference.setScore(gs.tasMap.get(taPreference.getTaId()).getScore());
		System.out.println(taPreference.getTaId() + " "+ taPreference.getCourseId()+" "+
				taPreference.getInterestLevel());
		}
		
		System.out.println("\n*** TA Time Constraints *** ");
		gs.taTimeConstraints = taTimeConstraintsDAO.selectAll();
		gs.taTimeConstraintsMap = gs.taTimeConstraints.stream().collect(Collectors.toMap(TATimeConstraints::getConstraintsId, item-> item));
		for (TATimeConstraints taTimeConstraint: gs.taTimeConstraints) {
		System.out.println(taTimeConstraint.getTaId() + " "+ taTimeConstraint.getConstraintsId()+" "+
				taTimeConstraint.getTimeInteravalNotAvilableId());
		}
		
		System.out.println("\n*** Time Intervals *** ");
		gs.timeIntervals = timeIntervalsDAO.selectAll();
		gs.taTimeConstraintsMap = gs.taTimeConstraints.stream().collect(Collectors.toMap(TATimeConstraints::getConstraintsId, item-> item));
		for (TimeIntervals timeInterval: gs.timeIntervals) {
		System.out.println(timeInterval.getTimeSlotId() + " "+ timeInterval.getDay() + " "+ timeInterval.getTimeDuration());
		}

		//run algorithm on data
		gs.runAlgorithm();
	}

}

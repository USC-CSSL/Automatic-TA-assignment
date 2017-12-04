/**
 * 
 */
package ta.course.assignment;

/**
 * @author rajdeepkaur
 *
 */
public class CourseSection {
	
	//primary key to identify each section
	private int sectionId;
	
	private String lectureCode;
	
	private String labCode;
	
	//parent course id
	private int courseId;
	
	private boolean isLecture;
	
	//time slot id for the course section
	private int timeSlotId;
	
	public String getLectureCode() {
		return lectureCode;
	}

	public void setLectureCode(String lectureCode) {
		this.lectureCode = lectureCode;
	}

	public String getLabCode() {
		return labCode;
	}

	public void setLabCode(String labCode) {
		this.labCode = labCode;
	}

	public boolean isLecture() {
		return isLecture;
	}

	public void setLecture(boolean isLecture) {
		this.isLecture = isLecture;
	}

	public int getSectionId() {
		return sectionId;
	}

	public void setSectionId(int sectionId) {
		this.sectionId = sectionId;
	}

	public int getCourseId() {
		return courseId;
	}

	public void setCourseId(int courseId) {
		this.courseId = courseId;
	}

	public int getTimeSlotId() {
		return timeSlotId;
	}

	public void setTimeSlotId(int timeSlotId) {
		this.timeSlotId = timeSlotId;
	}
	
}

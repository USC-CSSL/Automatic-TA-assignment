/**
 * 
 */
package ta.course.assignment;

/**
 * @author rajdeepkaur
 * Domain Class to represent each Course Avilable
 */
public class Course {
	
	//Unique Id to identify a Course
	private int courseId;
	
	private String CourseCode;
	
	private String Area;
	
	private int numberOfHalfTa;
	
	private int numberOfFullTa;
	
	private int isActive;

	public int getIsActive() {
		return isActive;
	}

	public void setIsActive(int isActive) {
		this.isActive = isActive;
	}

	public int getCourseId() {
		return courseId;
	}

	public void setCourseId(int courseId) {
		this.courseId = courseId;
	}

	public String getCourseCode() {
		return CourseCode;
	}

	public void setCourseCode(String courseCode) {
		CourseCode = courseCode;
	}

	public String getArea() {
		return Area;
	}

	public void setArea(String area) {
		Area = area;
	}

	public int getNumberOfHalfTa() {
		return numberOfHalfTa;
	}

	public void setNumberOfHalfTa(int numberOfHalfTa) {
		this.numberOfHalfTa = numberOfHalfTa;
	}

	public int getNumberOfFullTa() {
		return numberOfFullTa;
	}

	public void setNumberOfFullTa(int numberOfFullTa) {
		this.numberOfFullTa = numberOfFullTa;
	}

}

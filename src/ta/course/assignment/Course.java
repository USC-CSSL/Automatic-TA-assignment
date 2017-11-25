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
	
	//Attribute required in TA at highest preference
	private String Preference1;
	
	//Attribute required in TA at second preference
	private String Preference2;

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

	public String getPreference1() {
		return Preference1;
	}

	public void setPreference1(String preference1) {
		Preference1 = preference1;
	}

	public String getPreference2() {
		return Preference2;
	}

	public void setPreference2(String preference2) {
		Preference2 = preference2;
	}

}

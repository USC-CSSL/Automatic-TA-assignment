/**
 * 
 */
package ta.course.assignment;

/**
 * @author rajdeepkaur
 * Class to represent the preferences given by TAs
 */
public class TAPreferences {
	
	private int id;
	
	private int taId;
	
	private int courseId;
	
	private Boolean hasBeenTAForThisCourse;
	
	private int interestLevel;
	
	private float score; 

	public float getScore() {
		return score;
	}

	public void setScore(float score) {
		this.score = score;
	}

	public int getId() {
		return id;
	}

	public void setId(int id) {
		this.id = id;
	}

	public int getTaId() {
		return taId;
	}

	public void setTaId(int taId) {
		this.taId = taId;
	}

	public int getCourseId() {
		return courseId;
	}

	public void setCourseId(int courseId) {
		this.courseId = courseId;
	}

	public Boolean getHasBeenTAForThisCourse() {
		return hasBeenTAForThisCourse;
	}

	public void setHasBeenTAForThisCourse(Boolean hasBeenTAForThisCourse) {
		this.hasBeenTAForThisCourse = hasBeenTAForThisCourse;
	}

	public int getInterestLevel() {
		return interestLevel;
	}

	public void setInterestLevel(int interestLevel) {
		this.interestLevel = interestLevel;
	}

}

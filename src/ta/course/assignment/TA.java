/**
 * 
 */
package ta.course.assignment;

/**
 * @author rajdeepkaur
 * This is a domain class to represent each TA 
 */
public class TA {
	
	//Primary key to indetify each TA uniquely
	private int taId;
	
	private String area;
	
	private String previousCoursesTaught;
	
	private int courseTaughtLastSemester;
	
	private Boolean happyWithLastCourseTaught;
	
	private Boolean hasTAExperience;

	private String milestones;
	
	private float score; 

	private int hasTAExperianceForNumberOfSemester;
	
	private int isActive;
	
	public int getHasTAExperianceForNumberOfSemester() {
		return hasTAExperianceForNumberOfSemester;
	}

	public void setHasTAExperianceForNumberOfSemester(
			int hasTAExperianceForNumberOfSemester) {
		this.hasTAExperianceForNumberOfSemester = hasTAExperianceForNumberOfSemester;
	}

	public String getMilestoneId() {
		return milestones;
	}

	public void setMilestoneId(String milestones) {
		this.milestones = milestones;
	}

	public float getScore() {
		return score;
	}

	public void setScore(float score) {
		this.score = score;
	}

	public int getTaId() {
		return taId;
	}

	public void setTaId(int taId) {
		this.taId = taId;
	}

	public String getArea() {
		return area;
	}

	public void setArea(String area) {
		this.area = area;
	}

	public String getPreviousCoursesTaught() {
		return previousCoursesTaught.replaceAll("\\s","");
	}

	public void setPreviousCoursesTaught(String previousCoursesTaught) {
		this.previousCoursesTaught = previousCoursesTaught;
	}

	public Boolean getHasTAExperience() {
		return hasTAExperience;
	}

	public void setHasTAExperience(Boolean hasTAExperience) {
		this.hasTAExperience = hasTAExperience;
	}

	public int getCourseTaughtLastSemester() {
		return courseTaughtLastSemester;
	}

	public void setCourseTaughtLastSemester(int courseTaughtLastSemester) {
		this.courseTaughtLastSemester = courseTaughtLastSemester;
	}

	public Boolean getHappyWithLastCourseTaught() {
		return happyWithLastCourseTaught;
	}

	public void setHappyWithLastCourseTaught(Boolean happyWithLastCourseTaught) {
		this.happyWithLastCourseTaught = happyWithLastCourseTaught;
	}

	public int getIsActive() {
		return isActive;
	}

	public void setIsActive(int isActive) {
		this.isActive = isActive;
	}
	
}

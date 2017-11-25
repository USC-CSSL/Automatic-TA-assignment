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
	
	private String happyWithPreviousCoursesTaught;
	
	private Boolean hasTAExperience;

	private int milestoneId;
	
	private float score; 

	private int hasTAExperianceForNumberOfSemester;
	
	public int getHasTAExperianceForNumberOfSemester() {
		return hasTAExperianceForNumberOfSemester;
	}

	public void setHasTAExperianceForNumberOfSemester(
			int hasTAExperianceForNumberOfSemester) {
		this.hasTAExperianceForNumberOfSemester = hasTAExperianceForNumberOfSemester;
	}

	public int getMilestoneId() {
		return milestoneId;
	}

	public void setMilestoneId(int milestoneId) {
		this.milestoneId = milestoneId;
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
		return previousCoursesTaught;
	}

	public void setPreviousCoursesTaught(String previousCoursesTaught) {
		this.previousCoursesTaught = previousCoursesTaught;
	}

	public String getHappyWithPreviousCoursesTaught() {
		return happyWithPreviousCoursesTaught;
	}

	public void setHappyWithPreviousCoursesTaught(
			String happyWithPreviousCoursesTaught) {
		this.happyWithPreviousCoursesTaught = happyWithPreviousCoursesTaught;
	}

	public Boolean getHasTAExperience() {
		return hasTAExperience;
	}

	public void setHasTAExperience(Boolean hasTAExperience) {
		this.hasTAExperience = hasTAExperience;
	}
	
}

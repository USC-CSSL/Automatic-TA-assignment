/**
 * 
 */
package ta.course.assignment;

/**
 * @author rajdeepkaur
 *
 */
public class TATimeConstraints {

	//unique id to identify each constraint
	private int constraintsId;
	
	//TA who has specified this constraint
	private int taId;
	
	//time slot id when the TA is not avilable
	private int timeInteravalNotAvilableId;

	public int getConstraintsId() {
		return constraintsId;
	}

	public void setConstraintsId(int constraintsId) {
		this.constraintsId = constraintsId;
	}

	public int getTaId() {
		return taId;
	}

	public void setTaId(int taId) {
		this.taId = taId;
	}

	public int getTimeInteravalNotAvilableId() {
		return timeInteravalNotAvilableId;
	}

	public void setTimeInteravalNotAvilableId(int timeInteravalNotAvilableId) {
		this.timeInteravalNotAvilableId = timeInteravalNotAvilableId;
	}
	
}

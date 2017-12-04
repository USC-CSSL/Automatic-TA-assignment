/**
 * 
 */
package ta.course.assignment;

import java.sql.Time;

/**
 * @author rajdeepkaur
 *
 */
public class TimeIntervals {
	
	//unique id to identify time slots
	private int timeSlotId;
	
	//start time
	private String startTime;
	
	//end time
	private String endTime;
	
	//day of the slot
	private String day;

	public int getTimeSlotId() {
		return timeSlotId;
	}

	public void setTimeSlotId(int timeSlotId) {
		this.timeSlotId = timeSlotId;
	}

	public String getStartTime() {
		return startTime;
	}

	public void setStartTime(String startTime) {
		this.startTime = startTime;
	}

	public String getEndTime() {
		return endTime;
	}

	public void setEndTime(String endTime) {
		this.endTime = endTime;
	}

	public String getDay() {
		return day;
	}

	public void setDay(String day) {
		this.day = day;
	}
	
}

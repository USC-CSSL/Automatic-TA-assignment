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
	private Time startTime;
	
	//end time
	private Time endTime;
	
	//day of the slot
	private String day;

	public int getTimeSlotId() {
		return timeSlotId;
	}

	public void setTimeSlotId(int timeSlotId) {
		this.timeSlotId = timeSlotId;
	}

	public Time getStartTime() {
		return startTime;
	}

	public void setStartTime(Time startTime) {
		this.startTime = startTime;
	}

	public Time getEndTime() {
		return endTime;
	}

	public void setEndTime(Time endTime) {
		this.endTime = endTime;
	}

	public String getDay() {
		return day;
	}

	public void setDay(String day) {
		this.day = day;
	}
	
}

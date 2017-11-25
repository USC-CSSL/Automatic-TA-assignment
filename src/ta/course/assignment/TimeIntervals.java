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
	
	//time intervel of the slot
	private Time timeDuration;
	
	//day of the slot
	private String day;

	public int getTimeSlotId() {
		return timeSlotId;
	}

	public void setTimeSlotId(int timeSlotId) {
		this.timeSlotId = timeSlotId;
	}

	public Time getTimeDuration() {
		return timeDuration;
	}

	public void setTimeDuration(Time timeDuration) {
		this.timeDuration = timeDuration;
	}

	public String getDay() {
		return day;
	}

	public void setDay(String day) {
		this.day = day;
	}
	
}

/**
 * 
 */
package ta.course.assignment;

/**
 * @author rajdeepkaur
 * Domain class to represent each user
 */
public class User {
	
	//Primary Key to identify unique users
	private int userId;
	
	private String name;
	
	private Boolean isAdmin;

	public int getUserId() {
		return userId;
	}

	public void setUserId(int userId) {
		this.userId = userId;
	}

	public String getName() {
		return name;
	}

	public void setName(String name) {
		this.name = name;
	}

	public Boolean getIsAdmin() {
		return isAdmin;
	}

	public void setIsAdmin(Boolean isAdmin) {
		this.isAdmin = isAdmin;
	}
	
}

package ta.course.assignment.dao;

import java.util.List;

import org.apache.ibatis.session.SqlSession;
import org.apache.ibatis.session.SqlSessionFactory;

import ta.course.assignment.Course;
import ta.course.assignment.User;

public class CourseDAO {
	private SqlSessionFactory sqlSessionFactory = null;

	public CourseDAO(SqlSessionFactory sqlSessionFactory) {
		this.sqlSessionFactory = sqlSessionFactory;
	}

	/**
	 * Returns the list of all User instances from the database.
	 * 
	 * @return the list of all User instances from the database.
	 */
	@SuppressWarnings("unchecked")
	public List<Course> selectAll() {
		List<Course> list = null;
		SqlSession session = sqlSessionFactory.openSession();

		try {
			list = session.selectList("Course.selectAll");
		} finally {
			session.close();
		}
		// System.out.println("selectAll() --> "+list.toArray());
		return list;

	}
}

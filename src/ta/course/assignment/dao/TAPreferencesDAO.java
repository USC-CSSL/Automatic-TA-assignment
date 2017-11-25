package ta.course.assignment.dao;

import java.util.List;

import org.apache.ibatis.session.SqlSession;
import org.apache.ibatis.session.SqlSessionFactory;

import ta.course.assignment.TAPreferences;

public class TAPreferencesDAO {

	private SqlSessionFactory sqlSessionFactory = null;

	public TAPreferencesDAO(SqlSessionFactory sqlSessionFactory) {
		this.sqlSessionFactory = sqlSessionFactory;
	}

	/**
	 * Returns the list of all User instances from the database.
	 * 
	 * @return the list of all User instances from the database.
	 */
	@SuppressWarnings("unchecked")
	public List<TAPreferences> selectAll() {
		List<TAPreferences> list = null;
		SqlSession session = sqlSessionFactory.openSession();

		try {
			list = session.selectList("TAPreferences.selectAll");
		} finally {
			session.close();
		}
		// System.out.println("selectAll() --> "+list.toArray());
		return list;

	}

}

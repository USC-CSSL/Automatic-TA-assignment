package ta.course.assignment.dao;

import java.util.List;

import org.apache.ibatis.session.SqlSession;
import org.apache.ibatis.session.SqlSessionFactory;

import ta.course.assignment.Milestone;

public class MilestoneDAO {


	private SqlSessionFactory sqlSessionFactory = null;

	public MilestoneDAO(SqlSessionFactory sqlSessionFactory) {
		this.sqlSessionFactory = sqlSessionFactory;
	}

	/**
	 * Returns the list of all User instances from the database.
	 * 
	 * @return the list of all User instances from the database.
	 */
	@SuppressWarnings("unchecked")
	public List<Milestone> selectAll() {
		List<Milestone> list = null;
		SqlSession session = sqlSessionFactory.openSession();

		try {
			list = session.selectList("Milestone.selectAll");
		} finally {
			session.close();
		}
		// System.out.println("selectAll() --> "+list.toArray());
		return list;

	}

}

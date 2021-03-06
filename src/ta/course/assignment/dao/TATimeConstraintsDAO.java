package ta.course.assignment.dao;

import java.util.List;

import org.apache.ibatis.session.SqlSession;
import org.apache.ibatis.session.SqlSessionFactory;

import ta.course.assignment.TATimeConstraints;

public class TATimeConstraintsDAO {

	private SqlSessionFactory sqlSessionFactory = null;

	public TATimeConstraintsDAO(SqlSessionFactory sqlSessionFactory) {
		this.sqlSessionFactory = sqlSessionFactory;
	}

	/**
	 * Returns the list of all User instances from the database.
	 * 
	 * @return the list of all User instances from the database.
	 */
	@SuppressWarnings("unchecked")
	public List<TATimeConstraints> selectAll() {
		List<TATimeConstraints> list = null;
		SqlSession session = sqlSessionFactory.openSession();

		try {
			list = session.selectList("TATimeConstraints.selectAll");
		} finally {
			session.close();
		}
		// System.out.println("selectAll() --> "+list.toArray());
		return list;

	}

}

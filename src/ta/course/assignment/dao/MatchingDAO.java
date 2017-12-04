/**
 * 
 */
package ta.course.assignment.dao;

import java.util.List;
import java.util.Map;

import org.apache.ibatis.session.SqlSession;
import org.apache.ibatis.session.SqlSessionFactory;

import ta.course.assignment.Matching;

/**
 * @author rajdeepkaur
 *
 */
public class MatchingDAO {


	private SqlSessionFactory sqlSessionFactory = null;

	public MatchingDAO(SqlSessionFactory sqlSessionFactory) {
		this.sqlSessionFactory = sqlSessionFactory;
	}

	/**
	 * Returns the list of all matching instances from the database.
	 * 
	 * @return the list of all matching instances from the database.
	 */
	@SuppressWarnings("unchecked")
	public List<Matching> getAdminMatching() {
		List<Matching> list = null;
		SqlSession session = sqlSessionFactory.openSession();

		try {
			list = session.selectList("Matching.getAdminMatching");
		} finally {
			session.close();
		}
		// System.out.println("selectAll() --> "+list.toArray());
		return list;

	}
	
	public List<Matching> getMatching() {
		List<Matching> list = null;
		SqlSession session = sqlSessionFactory.openSession();

		try {
			list = session.selectList("Matching.getMatching");
		} finally {
			session.close();
		}
		// System.out.println("selectAll() --> "+list.toArray());
		return list;

	}
	
	public Matching getRunId() {
		Matching res = null;
		SqlSession session = sqlSessionFactory.openSession();

		try {
			res = session.selectOne("Matching.getLastRunId");
		} finally {
			session.close();
		}
		// System.out.println("selectAll() --> "+list.toArray());
		return res;

	}
	
	public void insertMatching(Map<String,Integer> map) {
		SqlSession session = sqlSessionFactory.openSession();
		try {
			session.insert("Matching.insertMatching",map);
		} finally {
			session.commit();
			session.close();
		}
	}

}

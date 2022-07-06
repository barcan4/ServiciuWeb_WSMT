package ServerJava.Repository;

import ServerJava.Model.Materie;
import ServerJava.Model.Nota;
import ServerJava.Model.Student;

import java.sql.*;
import java.util.ArrayList;
import java.util.List;

public class DBUtils {

    private Connection connection;

    public DBUtils() throws SQLException, ClassNotFoundException {
        Class.forName("com.mysql.jdbc.Driver");
        this.connection = DriverManager.getConnection(
                "jdbc:mysql://localhost:3306/studenti_db",
                "florin",
                "florin1");
    }

    public void addStudent(String nume, String prenume, String grupa) throws SQLException {
        String sql = "INSERT INTO student (nume, prenume, grupa) " +
                 " VALUES (?, ?, ?)";
        PreparedStatement stmt = connection.prepareStatement(sql);
        stmt.setString(1, nume);
        stmt.setString(2, prenume);
        stmt.setString(3, grupa);
        System.out.println("nume: " + nume + "; prenume: " + prenume + "; grupa: " + grupa);
        stmt.executeUpdate();
    }

    public void editStudent(int sID, String newNume, String newPrenume, String newGrupa) throws SQLException {
        String sql = "UPDATE student SET nume = ?, prenume = ?, grupa = ? where sID = ?";
        PreparedStatement stmt = connection.prepareStatement(sql);
        stmt.setString(1, newNume);
        stmt.setString(2, newPrenume);
        stmt.setString(3, newGrupa);
        stmt.setInt(4, sID);
        stmt.executeUpdate();
    }

    public void remStudent(int sID) throws SQLException {
        String sql = "DELETE FROM student where sID = ?";
        PreparedStatement stmt = connection.prepareStatement(sql);
        stmt.setInt(1, sID);
        stmt.executeUpdate();
    }

    public void addMaterie(String denumire, String profesor) throws SQLException {
        String sql = "INSERT INTO materie(denumire, profesor) VALUES (?, ?)";
        PreparedStatement stmt = connection.prepareStatement(sql);
        stmt.setString(1, denumire);
        stmt.setString(2, profesor);
        stmt.executeUpdate();
    }

    public void editMaterie(int mID, String newDenumire, String newProfesor) throws SQLException {
        String sql = "UPDATE materie SET denumire = ?, profesor = ? where mID = ?";
        PreparedStatement stmt = connection.prepareStatement(sql);
        stmt.setString(1, newDenumire);
        stmt.setString(2, newProfesor);
        stmt.setInt(3, mID);
        stmt.executeUpdate();
    }

    public void remMaterie(int mID) throws SQLException {
        String sql = "DELETE FROM materie where mID = ?";
        PreparedStatement stmt = connection.prepareStatement(sql);
        stmt.setInt(1, mID);
        stmt.executeUpdate();
    }

    public void addNota(int mark, String descriere, int sID, int mID) throws SQLException {
        String sql = "INSERT INTO nota(mark, descriere, sID, mID) VALUES (?, ?, ?, ?)";
        PreparedStatement stmt = connection.prepareStatement(sql);
        stmt.setInt(1, mark);
        stmt.setString(2, descriere);
        stmt.setInt(3, sID);
        stmt.setInt(4, mID);
        stmt.executeUpdate();
    }

    public void editNota(int nID, int newMark, String newDescriere) throws SQLException {
        String sql = "UPDATE nota SET mark = ?, descriere = ? where nID = ?";
        PreparedStatement stmt = connection.prepareStatement(sql);
        stmt.setInt(1, newMark);
        stmt.setString(2, newDescriere);
        stmt.setInt(3, nID);
        stmt.executeUpdate();
    }

    public List<String> listCatalog() throws SQLException {
        Statement stmt = connection.createStatement();
        ResultSet resultSet = stmt.executeQuery("SELECT m.denumire, m.profesor, n.mark, n.descriere, s.nume, s.prenume, s.grupa" +
                " FROM nota n INNER JOIN student s ON n.sID = s.sID" +
                " INNER JOIN materie m ON n.mID = m.mID");
        List<String> resultArray = new ArrayList<>();
        while (resultSet.next()) {
            String result = resultSet.getString(1) + " " +
                    resultSet.getString(2) + " " +
                    resultSet.getInt(3) + " " +
                    resultSet.getString(4) + " " +
                    resultSet.getString(5) + " " +
                    resultSet.getString(6) + " " +
                    resultSet.getString(7);
            resultArray.add(result);
        }

        return resultArray;
    }

    public List<Student> getStudenti() throws SQLException {
        Statement stmt = connection.createStatement();
        ResultSet resultSet = stmt.executeQuery("SELECT * from student");
        List<Student> resultArray = new ArrayList<>();
        while (resultSet.next()) {
            Student student = new Student(resultSet.getString("nume"),
                    resultSet.getString("prenume"),
                    resultSet.getString("grupa"));
            student.setsID(Integer.parseInt(resultSet.getString("sID")));
            resultArray.add(student);
        }
        return resultArray;
    }

    public Student getStudent(int sID) throws SQLException {
        Statement stmt = connection.createStatement();
        ResultSet resultSet = stmt.executeQuery("SELECT * from student where sID = " + sID);
        resultSet.next();
        Student student = new Student(resultSet.getString("nume"),
                resultSet.getString("prenume"),
                resultSet.getString("grupa"));
        student.setsID(Integer.parseInt(resultSet.getString("sID")));
        return student;
    }

    public List<Materie> getMaterii() throws SQLException {
        Statement stmt = connection.createStatement();
        ResultSet resultSet = stmt.executeQuery("SELECT * from materie");
        List<Materie> resultArray = new ArrayList<>();
        while (resultSet.next()) {
            Materie materie = new Materie(resultSet.getString("denumire"),
                    resultSet.getString("profesor"));
            materie.setmID(Integer.parseInt(resultSet.getString("mID")));
            resultArray.add(materie);
        }
        return resultArray;
    }

    public Materie getMaterie(int mID) throws SQLException {
        Statement stmt = connection.createStatement();
        ResultSet resultSet = stmt.executeQuery("SELECT * from materie where mID = " + mID);
        resultSet.next();
        Materie materie = new Materie(resultSet.getString("denumire"),
                resultSet.getString("profesor"));
        materie.setmID(Integer.parseInt(resultSet.getString("mID")));
        return materie;
    }

    public List<Nota> getNote() throws SQLException {
        Statement stmt = connection.createStatement();
        ResultSet resultSet = stmt.executeQuery("SELECT * from nota");
        List<Nota> resultArray = new ArrayList<>();
        while (resultSet.next()) {
            Nota nota = new Nota(Integer.parseInt(resultSet.getString("mark")),
                    resultSet.getString("descriere"),
                    Integer.parseInt(resultSet.getString("sID")),
                    Integer.parseInt(resultSet.getString("mID")));
            nota.setnID(Integer.parseInt(resultSet.getString("nID")));
            resultArray.add(nota);
        }
        return resultArray;
    }

    public Nota getNota(int nID) throws SQLException {
        Statement stmt = connection.createStatement();
        ResultSet resultSet = stmt.executeQuery("SELECT * from nota where nID = " + nID);
        resultSet.next();
        Nota nota = new Nota(Integer.parseInt(resultSet.getString("mark")),
                resultSet.getString("descriere"),
                Integer.parseInt(resultSet.getString("sID")),
                Integer.parseInt(resultSet.getString("mID")));
        nota.setnID(Integer.parseInt(resultSet.getString("nID")));
        return nota;
    }
}

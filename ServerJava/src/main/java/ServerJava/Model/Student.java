package ServerJava.Model;

import org.codehaus.jackson.annotate.JsonPropertyOrder;

@JsonPropertyOrder({"sID", "nume", "prenume", "grupa"})
public class Student {

    private int sID;
    private String nume;
    private String prenume;
    private String grupa;

    public Student(String nume, String prenume, String grupa) {
        this.nume = nume;
        this.prenume = prenume;
        this.grupa = grupa;
    }

    public Student() {}

    public int getsID() {
        return sID;
    }

    public void setsID(int sID) {
        this.sID = sID;
    }

    public String getNume() {
        return nume;
    }

    public void setNume(String nume) {
        this.nume = nume;
    }

    public String getPrenume() {
        return prenume;
    }

    public void setPrenume(String prenume) {
        this.prenume = prenume;
    }

    public String getGrupa() {
        return grupa;
    }

    public void setGrupa(String grupa) {
        this.grupa = grupa;
    }

    @Override
    public String toString() {
        return "Student{" +
                "sID=" + sID +
                ", nume='" + nume + '\'' +
                ", prenume='" + prenume + '\'' +
                ", grupa='" + grupa + '\'' +
                '}';
    }
}

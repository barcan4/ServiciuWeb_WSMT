package ServerJava.Model;

public class Materie {

    private int mID;
    private String denumire;
    private String profesor;

    public Materie(String denumire, String profesor) {
        this.denumire = denumire;
        this.profesor = profesor;
    }

    public Materie() {}

    public int getmID() {
        return mID;
    }

    public void setmID(int mID) {
        this.mID = mID;
    }

    public String getDenumire() {
        return denumire;
    }

    public void setDenumire(String denumire) {
        this.denumire = denumire;
    }

    public String getProfesor() {
        return profesor;
    }

    public void setProfesor(String profesor) {
        this.profesor = profesor;
    }

    @Override
    public String toString() {
        return "Materie{" +
                "mID=" + mID +
                ", denumire='" + denumire + '\'' +
                ", profesor='" + profesor + '\'' +
                '}';
    }
}

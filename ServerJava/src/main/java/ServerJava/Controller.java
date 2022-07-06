package ServerJava;

import ServerJava.Model.Materie;
import ServerJava.Model.Nota;
import ServerJava.Model.Student;
import ServerJava.Repository.DBUtils;

import javax.ws.rs.*;
import javax.ws.rs.core.MediaType;
import javax.ws.rs.core.Response;
import java.sql.SQLException;
import java.util.List;

@Path("/")
@Produces(MediaType.APPLICATION_JSON)
@Consumes(MediaType.APPLICATION_JSON)
public class Controller {

    private DBUtils db;

    public Controller() throws SQLException, ClassNotFoundException {
        this.db = new DBUtils();
    }

    @GET
    @Path("ceva")
    public Response ceva() {
        String str = "s-a scris ceva";
        return Response.status(202).entity(str).build();
    }

    @GET
    @Path("studenti")
    public Response getStudenti() {
        try {
            List<Student> studenti = db.getStudenti();
            return Response.ok(studenti).build();
        } catch (SQLException exception) {
            return Response.status(Response.Status.NOT_FOUND).build();
        }
    }

    @GET
    @Path("student/{sID}")
    public Response getStudent(@PathParam("sID") int sID) {
        try {
            Student student = db.getStudent(sID);
            return Response.ok(student).build();
        } catch (SQLException exception) {
            return Response.status(Response.Status.NOT_FOUND).build();
        }
    }

    @GET
    @Path("materii")
    public Response getMaterii() {
        try {
            List<Materie> materii = db.getMaterii();
            return Response.ok(materii).build();
        } catch (SQLException exception) {
            return Response.status(Response.Status.NOT_FOUND).build();
        }
    }

    @GET
    @Path("materie/{mID}")
    public Response getMaterie(@PathParam("mID") int mID) {
        try {
            Materie materie = db.getMaterie(mID);
            return Response.ok(materie).build();
        } catch (SQLException exception) {
            return Response.status(Response.Status.NOT_FOUND).build();
        }
    }

    @GET
    @Path("note")
    public Response getNote() {
        try {
            List<Nota> note = db.getNote();
            return Response.ok(note).build();
        } catch (SQLException exception) {
            return Response.status(Response.Status.NOT_FOUND).build();
        }
    }

    @GET
    @Path("nota/{nID}")
    public Response getNota(@PathParam("nID") int nID) {
        try {
            Nota nota = db.getNota(nID);
            return Response.ok(nota).build();
        } catch (SQLException exception) {
            return Response.status(Response.Status.NOT_FOUND).build();
        }
    }

    @GET
    @Path("catalog")
    public Response listCatalog() {
        try {
            List<String> catalog = db.listCatalog();
            return Response.ok(catalog).build();
        } catch (SQLException exception) {
            return Response.status(Response.Status.NOT_FOUND).build();
        }
    }

    @POST
    @Path("studenti")
    public Response addStudent(Student student) {
        try {
            db.addStudent(student.getNume(), student.getPrenume(), student.getGrupa());
            return Response.ok().status(Response.Status.CREATED).build();
        } catch (SQLException exception) {
            return Response.status(Response.Status.NOT_MODIFIED).build();
        }
    }

    @PUT
    @Path("student/{sID}")
    public Response editStudent(@PathParam("sID") int sID,
                                Student newStudent) {
        try {
            db.editStudent(sID, newStudent.getNume(), newStudent.getPrenume(), newStudent.getGrupa());
            return Response.ok().entity(db.getStudent(sID)).build();
        } catch (SQLException exception) {
            return Response.notModified().build();
        }
    }

    @DELETE
    @Path("student/{sID}")
    public Response remStudent(@PathParam("sID") int sID) {
        try {
            db.remStudent(sID);
            return Response.ok().status(Response.Status.NO_CONTENT).build();
        } catch (SQLException exception) {
            return Response.notModified().build();
        }
    }

    @POST
    @Path("materii")
    public Response addMaterie(Materie materie) {
        try {
            db.addMaterie(materie.getDenumire(), materie.getProfesor());
            return Response.ok().status(Response.Status.CREATED).build();
        } catch (SQLException exception) {
            return Response.status(Response.Status.NOT_MODIFIED).build();
        }
    }

    @PUT
    @Path("materie/{mID}")
    public Response editMaterie(@PathParam("mID") int mID,
                                Materie newMaterie) {
        try {
            db.editMaterie(mID, newMaterie.getDenumire(), newMaterie.getProfesor());
            return Response.ok().entity(db.getMaterie(mID)).build();
        } catch (SQLException exception) {
            return Response.notModified().build();
        }
    }

    @DELETE
    @Path("materie/{mID}")
    public Response remMaterie(@PathParam("mID") int mID) {
        try {
            db.remMaterie(mID);
            return Response.ok().status(Response.Status.NO_CONTENT).build();
        } catch (SQLException exception) {
            return Response.notModified().build();
        }
    }

    @POST
    @Path("note")
    public Response addNota(Nota nota) {
        try {
            db.addNota(nota.getMark(), nota.getDescriere(), nota.getsID(), nota.getmID());
            return Response.ok().status(Response.Status.CREATED).build();
        } catch (SQLException exception) {
            return Response.status(Response.Status.NOT_MODIFIED).build();
        }
    }

    @PUT
    @Path("nota/{nID}")
    public Response editNota(@PathParam("nID") int nID,
                                Nota newNota) {
        try {
            db.editNota(nID, newNota.getMark(), newNota.getDescriere());
            return Response.ok().entity(db.getNota(nID)).build();
        } catch (SQLException exception) {
            return Response.notModified().build();
        }
    }
}

package ServerJava;

import javax.ws.rs.core.Application;
import java.sql.SQLException;
import java.util.HashSet;
import java.util.Set;


public class Server extends Application {

    private Set<Object> singletons = new HashSet<>();

    public Server() {
        try {
            singletons.add(new Controller());
        } catch (SQLException | ClassNotFoundException throwable) {
            throwable.printStackTrace();
        }
    }

    @Override
    public Set<Object> getSingletons() {
        return singletons;
    }
}

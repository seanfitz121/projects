import java.io.IOException;

public class CLITest {
    public CLITest()
            throws IOException {
        Management manager = new Management();
        CLI menu = new CLI();
        menu.run();
    }
}

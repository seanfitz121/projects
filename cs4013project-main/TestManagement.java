import java.io.FileNotFoundException;
import java.io.PrintWriter;

public class TestManagement {
    public static void main(String[] args){
        /*PrintWriter writer = null;
        try {
            writer = new PrintWriter("record.csv");
        } catch (FileNotFoundException e) {
            e.printStackTrace();
        }
        writer.close();
        */
        Management Doe = new Management();
        TestOwner test = new TestOwner();
        test.testPassedOwner(Doe.registerOwner("Sam"));
        //test.testPassedOwner(Doe.registerOwner("Colum"));
        //Doe.getPropertyTaxFromEircode("V94WCV9");
        System.out.println(Doe.getPropertyTaxFromOwner("Sam"));
        Doe.getOverdueTaxForYear(2019);
        Doe.getOverdueTaxForYear("V94", 2019);
        Doe.getStats("V94");
    }
}

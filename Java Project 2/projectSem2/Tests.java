import java.util.*;
import java.io.*;
public class Tests
{
    public ArrayList<String> loadGoodWords(String filename, int shortest, int longest) {
        try {
            FileReader aFileReader = new FileReader(filename);
            BufferedReader aBufferReader = new BufferedReader(aFileReader);
            
            ArrayList<String> readWords = new ArrayList<String>();
            String word;
            
            word = aBufferReader.readLine();
            while (word != null) {
                if ((word.length() >= shortest) && (word.length() <= longest)){
                    readWords.add(word.toUpperCase());
                    word = aBufferReader.readLine();
                }
                }
                aBufferReader.close();
                aFileReader.close();
                return readWords;
        }
        catch(IOException x) {
            return null;
        }

    }
}

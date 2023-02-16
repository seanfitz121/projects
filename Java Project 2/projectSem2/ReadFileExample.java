 

import java.util.ArrayList ;
import java.io.* ;

public class ReadFileExample {
    public static void main(String[] args) {
        // BasicEnglish.txt - the 850 words of Basic English
        ArrayList<String> wordListA = loadWordsFromFile("BasicEnglish.txt"); //"BasicEnglish.txt") ;
        if(wordListA != null) {
            System.out.printf("Filename : BasicEnglish.txt\tWord Count : %,d\n",wordListA.size());
        } else {
            System.out.println("Filename : BasicEnglish.txt\tNOT FOUND");            
        }
        
        ArrayList<String> wordListB = loadWordsFromFile("BNCwords.txt") ;
        if(wordListB != null) {
            System.out.printf("Filename : BNCwords.txt\t\tWord Count : %,d\n",wordListB.size());
        } else {
            System.out.println("Filename : BNCwords.txt\tNOT FOUND");            
        }
        
        ArrayList<String> wordListC = loadWordsFromFile("blah blah blah"); 
        if(wordListC != null) {
            System.out.printf("Filename : blah blah blah\tWord Count : %,d\n",wordListC.size());
        } else {
            System.out.println("Filename : blah blah blah\tNOT FOUND");            
        }
    }
    
    private static ArrayList<String> loadWordsFromFile(String filename) {
        // Create an ArrayList and add each word read
        // from the named file to the list
        try {
            // The following statement attempts to get access to the file and open it.
            // If it fails it will "throw" (cause) an exception (error) that will
            // be "caught" by the "catch" code.
            FileReader aFileReader = new FileReader(filename);

            // If it succeeds it will connect to the file and give your program
            // read access to it. The system will also create a "buffer" (space)
            // to store the data transferred from the file and available to
            // your program.
            BufferedReader aBufferReader = new BufferedReader(aFileReader);
            
            // Now, we need to create the ArrayList that will store the words read from the file
            ArrayList<String> words = new ArrayList<String>();

            // Create a String variable to store just ONE word read from the file
            String aWord;

            // Start the process by ATTEMPTING to read the first word. If the file
            // is EMPTY (i.e. there are NO WORDS in the file) the system will return
            // a null value
            aWord = aBufferReader.readLine() ;
            // Check if we have reached the end of the file (i.e. there are no more
            // words in the file) and the system has returned a null result
            while (aWord != null) { 
                // MUST have read another word so add it ot the list
                words.add(aWord.toUpperCase());
                // Attempt to read the next one and repeat 'while' test
                aWord = aBufferReader.readLine() ;
            }
            // The 'while' has stopped so ALL the words in the file have been read
            // Remove the buffer from memory
            aBufferReader.close();
            // Close the file and allow access to it by others
            aFileReader.close();
            // return the reference to the ArrayList of words
            return words ;
        }
        catch(IOException x) {
            // An Input/Output exception (e.g. the file wasn't found, your program doesn't
            // have access rights to the file, etc.) has occurred.
            // Return a null reference value to signal that no data was read.
            return null ;
        }
    }
}
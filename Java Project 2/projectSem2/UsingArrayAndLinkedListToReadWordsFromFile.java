import java.util.ArrayList ;
import java.util.LinkedList ;
import java.io.* ;

public class UsingArrayAndLinkedListToReadWordsFromFile {
    public static void main(String[] args) {
        // 
        ArrayList<String> wordList1 = loadWordsFromFileStartingWith("BasicEnglish.txt", "a") ;
        System.out.println("Here are the " + wordList1.size() + " words in the BasicEnglish.txt file that start with 'A'") ;
        System.out.println(wordList1) ;
        ArrayList<String> wordList2 = loadWordsFromFileStartingWith("BNCWords.txt","des") ;
        System.out.println("Here are the " + wordList2.size() + " words in the BNCWords.txt file that start with 'DES'") ;
        System.out.println(wordList2) ;
    }
        
    private static ArrayList<String> loadWordsFromFileStartingWith(String filename, String wordPrefix) {
        try {
            FileReader aFileReader = new FileReader(filename);
            BufferedReader aBufferReader = new BufferedReader(aFileReader);
            String aWord;
            int wordsRead = 0;
            // Use a LinkedList while we are reading the words from the file
            LinkedList<String> chosenWords = new LinkedList<String>();
            aWord = aBufferReader.readLine() ;
            while (aWord != null) {
                wordsRead++;
                if(aWord.startsWith(wordPrefix)) {
                    chosenWords.add(aWord.toUpperCase());
                }
                aWord = aBufferReader.readLine() ;
            }
            aBufferReader.close();
            aFileReader.close();
            // Now transfer the words in the LinkedList to an ArrayList
            ArrayList<String> wordsWithPrefix = new ArrayList<String>(chosenWords);
            return wordsWithPrefix ;
        }
        catch(IOException x) {
            return null ;
        }
    }
}
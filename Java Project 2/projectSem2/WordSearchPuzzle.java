import java.util.*;
import java.io.*;
public class WordSearchPuzzle {
    
    public static ArrayList<String> readWords = new ArrayList<String>();
    public static ArrayList<String> betterWords = new ArrayList<String>();
    static int count;
    
    public WordSearchPuzzle(List<String> userSpecifiedWords) {
        int wordCount = userSpecifiedWords.size();
        WordSearchPuzzle.getDimensions(wordCount);
        
        this.generateWordSearchPuzzle();
        for(int i = wordCount; i > 0; i--){
            WordSearchPuzzle.placeWord(betterWords.get(i-1), puzzle);
            // WordSearchPuzzle above is next
            // then getPuzzleAsGrid then getPuzzleAsString
        }
    }

    public WordSearchPuzzle(String wordFile, int wordCount,int shortest, int longest){
        int i;
        WordSearchPuzzle.loadGoodWords(wordFile, shortest, longest);
        WordSearchPuzzle.betterWords(wordCount);
        WordSearchPuzzle.getDimensions(wordCount);
        
        this.generateWordSearchPuzzle();
        for(i = wordCount; i > 0; i--){
            WordSearchPuzzle.placeWord(betterWords.get(i-1), puzzle);
            // WordSearchPuzzle above is next
            // then getPuzzleAsGrid then getPuzzleAsString
        }
    }
    
    static char[][] puzzle = new char [count][count];
    private static ArrayList<String> loadGoodWords(String filename, int shortest, int longest) {
        try {
            FileReader aFileReader = new FileReader(filename);
            BufferedReader aBufferReader = new BufferedReader(aFileReader);
            
            
            String word;
            
            word = aBufferReader.readLine();
            while (word != null) {
                if ((word.length() >= shortest) && (word.length() <= longest)){
                    readWords.add(word.toUpperCase());
                    word = aBufferReader.readLine();
                }
                word = aBufferReader.readLine();
                }
                aBufferReader.close();
                aFileReader.close();
                return readWords;
        }
        catch(IOException x) {
            return null;
        }

    }
    
    private static ArrayList<String> betterWords(int wordCount){
        int length = readWords.size();
        int x;
        for(int i = 0; i < wordCount; i++){
            x = (int)(Math.random() * length);
            betterWords.add(i, readWords.get(x));
        }
        return betterWords;
    }
    
    public List<String> getWordSearchList() {
        return betterWords;
    }
        
    public static int getDimensions(int wordCount){
        boolean whole;
        for(int i = wordCount; i > 0; i--){
            count = count + (betterWords.get(i-1)).length();
        }
        count = (int)(count * 1.5);
        if((Math.sqrt(count) % 2) > 0){
            whole = false;
        }
        count = (int)(Math.sqrt(count));
        if (whole = false) {
            count = count + 1;
        }
        return count;
    }
    
    public static void placeWord(String word, char[][] puzzle) {
        int row, col, length = word.length()-1;
        int i = length;
        row = (int)(Math.random() * count);
        col = (int)(Math.random() * count);
        
        char[] letters = word.toCharArray();
        if(col+length >= 0 && col+length < count) {
            for( ;i >= col; i--){
                puzzle[row][col+i] = letters[i];
                
                // make it so the words don't cross each other!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
            }
        } else if (row + length >= 0 && row+length < count) {
            for( ;i >= row; i--){
                puzzle[row+i][col] = letters[i];
            }
        } else if (col-length >= 0 && col-length < count) {
            for( ;i >= col; i--){
                puzzle[row][col-i] = letters[i];
            }
        } else if (row-length >= 0 && row-length < count){
            for ( ;i >= row; i--){
                puzzle[row-i][col] = letters[i];
            }
        }
    }
    
    public char[][] getPuzzleAsGrid() {
        for (int i = 0; i < 5; i++) {
            System.out.print(puzzle[i]);
        }
        return puzzle;
    }
    
    private void generateWordSearchPuzzle(){
         
        
        
    }
        
    
      
}

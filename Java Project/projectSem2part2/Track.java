import java.util.*;
public class Track implements Comparable<Track>{
    // Colum Maher 19253443
    // Adam Butler 19244967
    // Sam Kingston Ryan 19263112
    // Sean Fitzgibbon 19273444
    // Daniel Larkin 19257503
    String title;
    String artist;
    int year, duration;
    public Track(String title, String artist) {
        this.title = title;
        this.artist = artist;
        this.year = 0;
        this.duration = 0;
    }
    public Track(String title, String artist, int year, int duration) {
        this.title = title;
        this.artist = artist;
        this.year = year;
        this.duration = duration;
    }
    public void setTitle (String title) {
        this.title = title;
    }
    public String getTitle () {
        return title;
    }
    public void setArtist (String artist) {
        this.artist = artist;
    }
    public String getArtist() {
        return artist;
    }
    public void setYear (int year) {
        this.year = year;
    }
    public int getYear() {
        return year;
    }
    public void setDuration (int duration) {
        this.duration = duration;
    }
    public int getDuration() {
        return duration;
    }
    public String ToString() {
        String s;
        int minutes = duration/60;
        int seconds = duration%60;
        if (seconds < 10) {
            s = (title + "\n" + artist + "\n" + year + "\n" + minutes + ":" + "0" + seconds + "\n");
        } else {
            s = (title + "\n" + artist + "\n" + year + "\n" + minutes + ":" + seconds + "\n");
        }
        System.out.printf(s);
        return s;
    }
    public int compareTo(Track other) {
        int last = this.title.compareToIgnoreCase(other.title);
        if (last == 0) {
           return this.artist.compareToIgnoreCase(other.artist);
        } else { 
             return last;
        }
    }
}
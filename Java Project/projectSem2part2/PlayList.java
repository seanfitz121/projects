import java.util.*;
public class PlayList
{
    // Colum Maher 19253443
    // Adam Butler 19244967
    // Sam Kingston Ryan 19263112
    // Sean Fitzgibbon 19273444
    // Daniel Larkin 19257503
    ArrayList<Track> Playlist = new ArrayList<Track>();
    String playListName;
    public PlayList(String listName) {
        ArrayList<Track> Playlist = new ArrayList<Track>();
        playListName = listName;
    }
    public PlayList() {
        ArrayList<Track> Playlist = new ArrayList<Track>();
        playListName = "My PlayList";
    }
    public String toString() {
        System.out.println ("----" + playListName + "----");
        System.out.println ();
        System.out.println ();
        String s = "";
        int minutes;
        int seconds;
        for (int i=0; i< Playlist.size(); i++){
            Track x = Playlist.get(i);
            String title = x.getTitle();
            String artist = x.getArtist();
            int year = x.getYear();
            int duration = x.getDuration();
            minutes = duration/60;
            seconds = duration%60;
            if (seconds < 10) {
                s = s + (title + "\n" + artist + "\n" + year + "\n" + minutes + ":" + "0" + seconds + "\n" + "\n");
            } else {
                s = s +(title + "\n" + artist + "\n" + year + "\n" + minutes + ":" + seconds + "\n" + "\n");
            }
        }
        System.out.printf(s);
        return s;
    }
    public void setName(String name){
        playListName = name;
    }
    public String getName(){
        return playListName;
    }
    public void add(Track track1) {
        Playlist.add(track1);
    }
    public void add(String title, String artist) {
        Track track1 = new Track(title, artist);
        Playlist.add(track1);
    }
    public void add(String title, String artist, int year, int duration) {
        Track track1 = new Track(title, artist, year, duration);
        Playlist.add(track1);
    }
    public void showList(){
        System.out.println ("----" + playListName + "----");
        System.out.println ();
        System.out.println ();
        if (Playlist.size() == 0) {
            System.out.println("The list is empty");
        } else {
            for (int i=0; i< Playlist.size(); i++){
                Track x = Playlist.get(i);
                x.ToString();
                System.out.println ();
            }
        }
    }
    public boolean remove(String title){
        title = title.toUpperCase();
        for (int i = 0; i<Playlist.size(); i++) {
            String otherTitle = Playlist.get(i).getTitle().toUpperCase();
            if (title.equals(otherTitle)){
                Playlist.remove(i);
                return true;
            }
        }
        return false;
    }
    public void playAll(boolean random){
        if (random == false) {
            for (int i=0; i< Playlist.size(); i++){
                Track x = Playlist.get(i);
                x.ToString();
                System.out.println ();
            }
        } else {
            ArrayList<Track> Played = new ArrayList<Track>();
            int j = 0;
            boolean match = false;
            while (j<Playlist.size()) {
                int randomNum = (int) (Math.random()*Playlist.size());
                match = false;
                Track randomTrack = Playlist.get(randomNum);
                if (Played.contains(randomTrack)) {
                    match = true;
                    //Playlist.get(k).ToString();
                    //Playlist.get(randomNum).ToString();
                }
                if (match == false) {
                    Played.add(randomTrack);
                    j++;
                    randomTrack.ToString();
                    System.out.println ();
                }
            }
        }
    }
    public void playOnly(String artist){
        artist = artist.toUpperCase();
        for (int i = 0; i<Playlist.size(); i++) {
            Track track = Playlist.get(i);
            String thisArtist = track.getArtist().toUpperCase();
            if (thisArtist.contains(artist)) {
                track.ToString();
                System.out.println();
            }
        }
    }
    public void playOnly(int year){
        for (int i = 0; i<Playlist.size(); i++) {
            Track track = Playlist.get(i);
            if (track.getYear() == year) {
                track.ToString();
                System.out.println();
            }
        }   
    }
    public void sort(){
        for (int i = 0; i<Playlist.size(); i++) {
            for (int y = 0; y<Playlist.size()-1; y++) {
                Track track1 = Playlist.get(y);
                Track track2 = Playlist.get(y+1);
                if (track2.compareTo(track1) < 0) {
                    // switch title2 to title1
                    Playlist.set(y, track2);
                    Playlist.set(y+1, track1);
                }
            }
        }
    }
}
    

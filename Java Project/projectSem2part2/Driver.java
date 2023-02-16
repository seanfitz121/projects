import java.util.*;
import java.io.*;
public class Driver
{
    // N.B NEEDS Unlimited Buffering ON to print everything.
    // Colum Maher 19253443
    // Adam Butler 19244967
    // Sam Kingston Ryan 19263112
    // Sean Fitzgibbon 19273444
    // Daniel Larkin 19257503
    public static void main(String[] args) {
        Track track1 = new Track("Hello", "Adele", 2012, 210);
        Track track2 = new Track("Boiler Room Mashup", "Le Biggus Chungus", 2016, 500);
        Track track3 = new Track("Dejavu", "Post Malone", 2016, 150);
        PlayList MyPlaylist = new PlayList("A Playlist");
        PlayList MyPlaylist2 = new PlayList();
        MyPlaylist.add(track1);
        MyPlaylist.add(track2);
        MyPlaylist.add(track3);
        MyPlaylist.add("Circles", "Post Malone", 2017, 233);
        MyPlaylist.add("Hotel California", "The Eagles", 1975, 310);
        MyPlaylist.add("ainsleyharriott.exe", "H3H3", 2016, 30);
        MyPlaylist.add("Seven Nation Army", "The White Stripes");
        MyPlaylist.add("California Love", "Tupac", 1988, 250);
        MyPlaylist.sort();
        System.out.println("An alphabetically sorted PlayList");
        System.out.println();
        MyPlaylist.showList();
        System.out.println();
        System.out.println();
        System.out.println();
        System.out.println("An empty PlayList with an automatically generated name");
        System.out.println();
        MyPlaylist2.showList();
        System.out.println();
        System.out.println();
        System.out.println();
        System.out.println("An alphabetically sorted PlayList as a String");
        System.out.println();
        MyPlaylist.toString();
        System.out.println();
        System.out.println();
        System.out.println();
        System.out.println("Renaming the PlayList to Dermot's Playlist");
        System.out.println();
        MyPlaylist.setName("Dermot's Playlist");
        MyPlaylist.showList();
        System.out.println();
        System.out.println();
        System.out.println();
        System.out.println("The PlayList played in Sequence");
        System.out.println();
        MyPlaylist.playAll(false);
        System.out.println();
        System.out.println();
        System.out.println();
        System.out.println("The PlayList played Randomly");
        System.out.println();
        MyPlaylist.playAll(true);
        System.out.println();
        System.out.println("The PlayList played Randomly again");
        System.out.println();
        MyPlaylist.playAll(true);
        System.out.println();
        System.out.println();
        System.out.println();
        System.out.println("Only songs released in 2016");
        System.out.println();
        MyPlaylist.playOnly(2016);
        System.out.println();
        System.out.println();
        System.out.println();
        System.out.println("Only songs released in 2000 (None)");
        System.out.println();
        MyPlaylist.playOnly(2000);
        System.out.println();
        System.out.println();
        System.out.println();
        System.out.println("Only songs released by Eagles");
        System.out.println();
        MyPlaylist.playOnly("Eagles");
        System.out.println();
        System.out.println();
        System.out.println();
        System.out.println("Only songs released by EaGleS");
        System.out.println();
        MyPlaylist.playOnly("EaGleS");
        System.out.println();
        System.out.println();
        System.out.println();
        System.out.println("Only songs released by Le Biggus Chungus");
        System.out.println();
        MyPlaylist.playOnly("Le Biggus Chungus");
        MyPlaylist.remove("Hello");
        System.out.println();
        System.out.println();
        System.out.println();
        System.out.println("The PlayList after removing Hello by Adele");
        System.out.println();
        MyPlaylist.showList();
        System.out.println();
        System.out.println();
        System.out.println();
        System.out.println("The PlayList after removing DragonPhoenix");
        System.out.println();
        MyPlaylist.remove("DragonPhoenix");
        MyPlaylist.showList();
    }
}

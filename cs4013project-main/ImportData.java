import java.io.BufferedReader;
import java.io.FileNotFoundException;
import java.io.FileReader;
import java.io.IOException;
import java.util.ArrayList;
import java.util.Arrays;

public class ImportData {
    //read owners + create owners and then from owners create each property for that owner
    public ImportData(Management Doe){
        String row;
        BufferedReader csvReader = null;
        boolean exists = false;
        try {
            csvReader = new BufferedReader(new FileReader("data.csv"));
            while ((row = csvReader.readLine()) != null) {
                String[] data = row.split(",");
                for(int i = 0; i < data.length; i++){
                    exists = false;
                    for(int j = 0; j < Doe.getOwners().size(); j++){
                        if (data[i].equals(Doe.getOwners().get(j).getName())){
                            exists = true;
                            Doe.getOwners().get(j).registerProperty(data[i+1],data[i+2],Double.parseDouble(data[i+3]),data[i+4],Boolean.parseBoolean(data[i+5]),Integer.parseInt(data[i+6]));
                        }
                    }
                    if (exists){
                    } else if(i%7==0){
                        Doe.registerOwner(data[i]);
                        Doe.getOwners().get(Doe.getOwners().size()-1).registerProperty(data[i+1],data[i+2],Double.parseDouble(data[i+3]),data[i+4],Boolean.parseBoolean(data[i+5]),Integer.parseInt(data[i+6]));
                    }
                }
            }
            csvReader.close();
        } catch (FileNotFoundException e) {
            e.printStackTrace();
        } catch (IOException e) {
            e.printStackTrace();
        }
    }
}


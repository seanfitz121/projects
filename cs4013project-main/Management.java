import java.io.BufferedReader;
import java.io.FileNotFoundException;
import java.io.FileReader;
import java.io.IOException;
import java.util.ArrayList;
import java.util.Arrays;

public class Management
{
    private ArrayList<Owner> owners = new ArrayList<>();
    public Management(){
    }
    public Owner registerOwner(String name){
        Owner o = new Owner(name);
        owners.add(o);
        return o;
    }
    public void getPropertyTaxFromEircode(String eircode){
        String row;
        BufferedReader csvReader = null;
        System.out.println("Property tax for Eircode:" + eircode);
        try {
            csvReader = new BufferedReader(new FileReader("record.csv"));
            while ((row = csvReader.readLine()) != null) {
                String[] data = row.split(",");
                for(int i = 0; i < data.length; i++){
                    if (data[i].equals(eircode)) {
                        System.out.println(data[i] + " " + data[i + 1] + " " + data[i + 2] + " " + data[i + 3]);
                    }
                }
            }
            System.out.println();
            csvReader.close();
        } catch (FileNotFoundException e) {
            e.printStackTrace();
        } catch (IOException e) {
            e.printStackTrace();
        }
    }
    public ArrayList<String> getPropertyTaxFromOwner(String name){
        String row;
        BufferedReader csvReader = null;
        System.out.println("Property tax for " + name);
        ArrayList<String> s = new ArrayList<String>();
        for(int y = 0; y < owners.size(); y++) {
            Owner o = owners.get(y);
            if (o.getName().equals(name)) {
                for(int x = 0; x < o.getProperties().size(); x++) {
                    String eircode = o.getProperties().get(x).getEircode();
                    try {
                        csvReader = new BufferedReader(new FileReader("record.csv"));
                        while ((row = csvReader.readLine()) != null) {
                            String[] data = row.split(",");
                            for (int i = 0; i < data.length; i++) {
                                if (data[i].equals(eircode)) {
                                    s.add(data[i] + " " + data[i + 1] + " " + data[i + 2] + " " + data[i + 3]);
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
        }
        return s;
    }
    public void getOverdueTaxForYear(int year){
        String s = "";
        for(int i = 0; i < owners.size(); i++){
            s = s + ("\nTaxes Overdue for " + owners.get(i).getName() + " in " + year +":\n");
            s = s + owners.get(i).viewOverdueTax(year);
        }
    }
    public void getOverdueTaxForYear(String routKey, int year){
        for(int i = 0; i < owners.size(); i++){
            System.out.println("Taxes Overdue for " + owners.get(i).getName() + " in " + routKey +":");
            owners.get(i).viewOverdueTax(routKey, year);
        }
    }
    public String getStats(String routKey){
        String s = "";
        s = "\nStats for " + routKey +"\n";
        double totalTax = getTotalTax(routKey);
        s = s + "Total Tax: " + totalTax + "\n";
        double[] avgAndAmount = new double[2];
        avgAndAmount = getAverageAndAmount(routKey);
        double averageTax = avgAndAmount[0];
        s = s + "Average Tax: " + averageTax + "\n";
        int number = (int)avgAndAmount[1];
        s = s + "Number of Payments: " + number + "\n";
        double percentage = getPercentage(routKey, number);
        s = s + "Percentage of Taxes Paid: " + percentage + "\n";
        return s;
    }
    private double getTotalTax(String routKey) {
        //Total Tax Paid for Area
        double totalTax = 0;
        String row;
        BufferedReader csvReader = null;

        try {
            csvReader = new BufferedReader(new FileReader("record.csv"));
            while ((row = csvReader.readLine()) != null) {
                String[] data = row.split(",");
                for (int i = 0; i < data.length; i++) {
                    if (data[i].substring(0, 3).equals(routKey)) {
                        totalTax = totalTax + Double.parseDouble(data[i + 1]);
                    }
                }
            }
            csvReader.close();
        } catch (FileNotFoundException e) {
            e.printStackTrace();
        } catch (IOException e) {
            e.printStackTrace();
        }

        return totalTax;
    }
    private double[] getAverageAndAmount(String routKey){
        //Total Tax Paid for Area
        double averageTax = 0;
        ArrayList<Double> numbers = new ArrayList<>();
        String row;
        BufferedReader csvReader = null;

            try {
                csvReader = new BufferedReader(new FileReader("record.csv"));
                while ((row = csvReader.readLine()) != null) {
                    String[] data = row.split(",");
                    for (int i = 0; i < data.length; i++) {
                        if (data[i].substring(0,3).equals(routKey)) {
                            numbers.add(Double.parseDouble(data[i+1]));
                        }
                    }
                }
                csvReader.close();
            } catch (FileNotFoundException e) {
                e.printStackTrace();
            } catch (IOException e) {
                e.printStackTrace();
            }

        int count = 0;
        for(int i = 0; i < numbers.size(); i++, count++){
            averageTax = averageTax + numbers.get(i);
        }
        return new double[]{averageTax / count, count};
    }
    private double getPercentage(String routKey, int count){
        int amount = 0;
        for(int i = 0; i < owners.size(); i++){
            for(int j = 0; j < owners.get(i).getProperties().size(); j++) {
                Property p = owners.get(i).getProperties().get(j);
                if(p.getEircode().substring(0,3).equals(routKey)){
                    amount = amount + p.getTaxHistory().size();
                }
            }
        }
        return (((double)count)/((double)amount))*100;
    }
    public String tweakMarketTaxBand(String name, double upperBand, double middleBand, double lowerBand){
        double taxBefore = 0;
        double taxAfter = 0;
        double beforeCount = 0;
        double afterCount = 0;
        String s = "";
        for(int j = 0; j < owners.size(); j++) {
            if (owners.get(j).getName().equals(name)) {
                for (int x = 0; x < owners.get(j).getProperties().size(); x++) {
                    Property p = owners.get(j).getProperties().get(x);
                    taxBefore = 0;
                    taxAfter = 0;
                    for (int i = 0; i < p.getTaxHistory().size(); i++) {
                        taxBefore = taxBefore + p.getTaxHistory().get(i).getPropertyTax(p.getTaxHistory().get(i).getAddress(), p.getTaxHistory().get(i).getEircode(), p.getTaxHistory().get(i).getMarketValue(), p.getTaxHistory().get(i).getLocationCategory(), p.getTaxHistory().get(i).isPpr(), p.getTaxHistory().get(i).getRegYear(), p.getTaxHistory().get(i).getYear());
                        p.getTaxHistory().get(i).setUpperBand(upperBand);
                        p.getTaxHistory().get(i).setMiddleBand(middleBand);
                        p.getTaxHistory().get(i).setLowerBand(lowerBand);
                        taxAfter = taxAfter + p.getTaxHistory().get(i).getPropertyTax(p.getTaxHistory().get(i).getAddress(), p.getTaxHistory().get(i).getEircode(), p.getTaxHistory().get(i).getMarketValue(), p.getTaxHistory().get(i).getLocationCategory(), p.getTaxHistory().get(i).isPpr(), p.getTaxHistory().get(i).getRegYear(), p.getTaxHistory().get(i).getYear());;
                    }
                    beforeCount = beforeCount + taxBefore;
                    afterCount = afterCount + taxAfter;
                }
            }
        }
        s = s + ("\nTax Before:" + beforeCount);
        s = s + ("\nTax After:" + afterCount);
        return s;
    }
    public String tweakMarketTaxPercentages(String name, double upperBandPerc, double middleBandPerc, double lowerBandPerc){
        double taxBefore = 0;
        double taxAfter = 0;
        double beforeCount = 0;
        double afterCount = 0;
        String s = "";
        for(int j = 0; j < owners.size(); j++) {
            if (owners.get(j).getName().equals(name)) {
                for (int x = 0; x < owners.get(j).getProperties().size(); x++) {
                    Property p = owners.get(j).getProperties().get(x);
                    taxBefore = 0;
                    taxAfter = 0;
                    for (int i = 0; i < p.getTaxHistory().size(); i++) {
                        taxBefore = taxBefore + p.getTaxHistory().get(i).getPropertyTax(p.getTaxHistory().get(i).getAddress(), p.getTaxHistory().get(i).getEircode(), p.getTaxHistory().get(i).getMarketValue(), p.getTaxHistory().get(i).getLocationCategory(), p.getTaxHistory().get(i).isPpr(), p.getTaxHistory().get(i).getRegYear(), p.getTaxHistory().get(i).getYear());
                        p.getTaxHistory().get(i).setUpperBandPerc(upperBandPerc);
                        p.getTaxHistory().get(i).setMiddleBandPerc(middleBandPerc);
                        p.getTaxHistory().get(i).setLowerBandPerc(lowerBandPerc);
                        taxAfter = taxAfter + p.getTaxHistory().get(i).getPropertyTax(p.getTaxHistory().get(i).getAddress(), p.getTaxHistory().get(i).getEircode(), p.getTaxHistory().get(i).getMarketValue(), p.getTaxHistory().get(i).getLocationCategory(), p.getTaxHistory().get(i).isPpr(), p.getTaxHistory().get(i).getRegYear(), p.getTaxHistory().get(i).getYear());
                    }
                    beforeCount = beforeCount + taxBefore;
                    afterCount = afterCount + taxAfter;
                }
            }
        }
        s = s + ("\nTax Before:" + beforeCount);
        s = s + ("\nTax After:" + afterCount);
        return s;
    }
    public String tweakPenalty(String name, double penalty){
        double taxBefore = 0;
        double taxAfter = 0;
        double beforeCount = 0;
        double afterCount = 0;
        String s = "";
        for(int j = 0; j < owners.size(); j++) {
            if (owners.get(j).getName().equals(name)) {
                for (int x = 0; x < owners.get(j).getProperties().size(); x++) {
                    Property p = owners.get(j).getProperties().get(x);
                    taxBefore = 0;
                    taxAfter = 0;
                    for (int i = 0; i < p.getTaxHistory().size(); i++) {
                        taxBefore = taxBefore + p.getTaxHistory().get(i).getPropertyTax(p.getTaxHistory().get(i).getAddress(), p.getTaxHistory().get(i).getEircode(), p.getTaxHistory().get(i).getMarketValue(), p.getTaxHistory().get(i).getLocationCategory(), p.getTaxHistory().get(i).isPpr(), p.getTaxHistory().get(i).getRegYear(), p.getTaxHistory().get(i).getYear());;
                        p.getTaxHistory().get(i).setPenalty(penalty);
                        taxAfter = taxAfter + p.getTaxHistory().get(i).getPropertyTax(p.getTaxHistory().get(i).getAddress(), p.getTaxHistory().get(i).getEircode(), p.getTaxHistory().get(i).getMarketValue(), p.getTaxHistory().get(i).getLocationCategory(), p.getTaxHistory().get(i).isPpr(), p.getTaxHistory().get(i).getRegYear(), p.getTaxHistory().get(i).getYear());;
                    }
                    beforeCount = beforeCount + taxBefore;
                    afterCount = afterCount + taxAfter;
                }
            }
        }
        s = s + ("\nTax Before:" + beforeCount);
        s = s + ("\nTax After:" + afterCount);
        return s;
    }
    public String tweakLocationTax(String name, double City, double LargeT, double SmallT, double Village, double Countryside){
        double taxBefore = 0;
        double taxAfter = 0;
        double beforeCount = 0;
        double afterCount = 0;
        String s = "";
        for(int j = 0; j < owners.size(); j++) {
            if (owners.get(j).getName().equals(name)) {
                for (int x = 0; x < owners.get(j).getProperties().size(); x++) {
                    Property p = owners.get(j).getProperties().get(x);
                    taxBefore = 0;
                    taxAfter = 0;
                    for (int i = 0; i < p.getTaxHistory().size(); i++) {
                        taxBefore = taxBefore + p.getTaxHistory().get(i).getPropertyTax(p.getTaxHistory().get(i).getAddress(), p.getTaxHistory().get(i).getEircode(), p.getTaxHistory().get(i).getMarketValue(), p.getTaxHistory().get(i).getLocationCategory(), p.getTaxHistory().get(i).isPpr(), p.getTaxHistory().get(i).getRegYear(), p.getTaxHistory().get(i).getYear());;
                        p.getTaxHistory().get(i).setCity(City);
                        p.getTaxHistory().get(i).setLargeT(LargeT);
                        p.getTaxHistory().get(i).setSmallT(SmallT);
                        p.getTaxHistory().get(i).setVillage(Village);
                        p.getTaxHistory().get(i).setCountryside(Countryside);
                        taxAfter = taxAfter + p.getTaxHistory().get(i).getPropertyTax(p.getTaxHistory().get(i).getAddress(), p.getTaxHistory().get(i).getEircode(), p.getTaxHistory().get(i).getMarketValue(), p.getTaxHistory().get(i).getLocationCategory(), p.getTaxHistory().get(i).isPpr(), p.getTaxHistory().get(i).getRegYear(), p.getTaxHistory().get(i).getYear());;
                    }
                    beforeCount = beforeCount + taxBefore;
                    afterCount = afterCount + taxAfter;
                }
            }
        }
        s = s + ("\nTax Before:" + beforeCount);
        s = s + ("\nTax After:" + afterCount);
        return s;
    }
    public String tweakPPRTax(String name, double pprVal){
        double taxBefore = 0;
        double taxAfter = 0;
        double beforeCount = 0;
        double afterCount = 0;
        String s = "";
        for(int j = 0; j < owners.size(); j++) {
            if (owners.get(j).getName().equals(name)) {
                for (int x = 0; x < owners.get(j).getProperties().size(); x++) {
                    Property p = owners.get(j).getProperties().get(x);
                    taxBefore = 0;
                    taxAfter = 0;
                    for (int i = 0; i < p.getTaxHistory().size(); i++) {
                        taxBefore = taxBefore + p.getTaxHistory().get(i).getPropertyTax(p.getTaxHistory().get(i).getAddress(), p.getTaxHistory().get(i).getEircode(), p.getTaxHistory().get(i).getMarketValue(), p.getTaxHistory().get(i).getLocationCategory(), p.getTaxHistory().get(i).isPpr(), p.getTaxHistory().get(i).getRegYear(), p.getTaxHistory().get(i).getYear());;
                        p.getTaxHistory().get(i).setPprVal(pprVal);
                        taxAfter = taxAfter + p.getTaxHistory().get(i).getPropertyTax(p.getTaxHistory().get(i).getAddress(), p.getTaxHistory().get(i).getEircode(), p.getTaxHistory().get(i).getMarketValue(), p.getTaxHistory().get(i).getLocationCategory(), p.getTaxHistory().get(i).isPpr(), p.getTaxHistory().get(i).getRegYear(), p.getTaxHistory().get(i).getYear());;
                    }
                    beforeCount = beforeCount + taxBefore;
                    afterCount = afterCount + taxAfter;
                }
            }
        }
        s = s + ("\nTax Before:" + beforeCount);
        s = s + ("\nTax After:" + afterCount);
        return s;
    }
    public ArrayList<Owner> getOwners(){
        System.out.println();
        return this.owners;
    }
}

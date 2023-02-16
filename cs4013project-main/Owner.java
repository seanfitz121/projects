import java.io.BufferedReader;
import java.io.FileNotFoundException;
import java.io.FileReader;
import java.io.IOException;
import java.util.ArrayList;

public class Owner {

    private String name;
    /*List of properties*/
    private ArrayList<Property> properties = new ArrayList<>();
    public Owner(String name){
        this.name = name;
    }
    public void registerProperty(String address, String eircode, double marketValue, String locationCategory, boolean ppr, int year){
        Property p = new Property(address, eircode, marketValue, locationCategory, ppr, year);
        p.createTaxHistory();
        properties.add(p);

    }
    public void registerProperty(Property p){
        p.createTaxHistory();
        properties.add(p);
    }
    public String viewProperties(){
        /* Prints properties array */
        String s = "";
        for (int i = 0; i< properties.size(); i++){
            s = s + "\n --------------- \n" + properties.get(i).toString();
        }
        return s;
    }
    public void payTax(Property p, int year){
        /* Take payment, create propertyTax, store in property.(Implement in PropertyTax)*/
        ArrayList<PropertyTax> history = p.getTaxHistory();
        for (int i = 0; i < history.size(); i++){
            if(history.get(i).getYear() == year){
                history.get(i).setPaid();
            }
        }
    }
    public String viewPaidTax(){
        /* Prints all PAID Taxes */
        String s = "";
        for (int i = 0; i< properties.size(); i++){
            Property p = properties.get(i);
            s = "\nTaxes Paid for Property at " + String.valueOf(p.getAddress());
            ArrayList<PropertyTax> history = p.getTaxHistory();
            for (int y = 0; y < history.size(); y++){
                PropertyTax tax = history.get(y);
                if (tax.getPaid()){
                    s = s + "\nYear: " + tax.getYear() + "\nTax Paid: " + tax.getTax();
                }
            }
        }
        return s;
    }
    public String viewDueTax(){
        /* Prints THIS YEARS DUE Taxes */
        String s = "";
        for (int i = 0; i< properties.size(); i++){
            Property p = properties.get(i);
            s = "\nTax Due this year for Property at " + p.getAddress();
            ArrayList<PropertyTax> history = p.getTaxHistory();
            for (int y = 0; y < history.size(); y++){
                PropertyTax tax = history.get(y);
                if (!tax.getPaid()&&(tax.getYear() == 2020)){
                    s = s + "\nTax Due: " + tax.getTax();
                }
            }
        }
        return s;
    }
    public String viewOverdueTax(){
        /* Prints all OVERDUE Taxes, i.e NOT this years */
        String s = "";
        for (int i = 0; i< properties.size(); i++){
            Property p = properties.get(i);
            s = s + ("\nTaxes Overdue for Property at " + p.getAddress());
            ArrayList<PropertyTax> history = p.getTaxHistory();
            for (int y = 0; y < history.size(); y++){
                PropertyTax tax = history.get(y);
                if ((!tax.getPaid())&&(tax.getYear() != 2020)){
                    s = s + ("\nYear: " + tax.getYear() + "\nTax Overdue: " + tax.getTax());
                }
            }
        }
        return s;
    }
    public String viewOverdueTax(int year){
        /* Prints all OVERDUE Taxes for a YEAR */
        String s = "";
        for (int i = 0; i< properties.size(); i++){
            Property p = properties.get(i);

            ArrayList<PropertyTax> history = p.getTaxHistory();
            for (int y = 0; y < history.size(); y++){
                PropertyTax tax = history.get(y);
                if ((!tax.getPaid())&&(tax.getYear() == year)){
                    s = s + ("\nTaxes Overdue for Property at " + p.getAddress());
                    s = s + ("\nTax Overdue: " + tax.getTax());
                }
            }
        }
        return s;
    }
    public String viewOverdueTax(String routKey, int year){
        /* Prints all OVERDUE Taxes for a YEAR in a ROUTING KEY*/
        String s = "";
        for (int i = 0; i< properties.size(); i++){
            Property p = properties.get(i);

            ArrayList<PropertyTax> history = p.getTaxHistory();
            for (int y = 0; y < history.size(); y++){
                PropertyTax tax = history.get(y);
                if ((!tax.getPaid())&&(tax.getEircode().substring(0,3).equals(routKey))&&(tax.getYear() == year)){
                    s = s + ("\nTaxes Overdue for Property at " + p.getAddress());
                    s = s + ("\nTax Overdue: " + tax.getTax());
                }
            }
        }
        return s;
    }
    public String balancingStatement(int year){
        /* Shows amount of tax, paid and unpaid, for specific year*/
        double unpaid = 0;
        double paid = 0;
        for (int i = 0; i< properties.size(); i++){
            Property p = properties.get(i);
            ArrayList<PropertyTax> history = p.getTaxHistory();
            for (int j = 0; j < history.size(); j++){
                PropertyTax tax = history.get(j);
                if (tax.getYear() == year){
                    if (tax.getPaid()){
                        paid = paid + tax.getTax();
                    } else {
                        unpaid = unpaid + tax.getTax();
                    }
                }
            }
        }
        String s = "";
        s = "\nPaid tax in this year: " + year + ", " + paid;
        s = s + "\nUnpaid tax in this year: " + year + ", " + unpaid;
        return s;
    }
    public String balancingStatement(Property p){
        /* Shows amount of tax paid for specific Property*/
        ArrayList<PropertyTax> history = p.getTaxHistory();
        String s = "";
        s = "\nAll taxes for Property at " + p.getAddress();
        for (int y = 0; y < history.size(); y++){
            PropertyTax tax = history.get(y);
            if (tax.getPaid()){
                s = s + "\nYear: " + tax.getYear() + "\nTax Paid: " + tax.getTax();
            } else {
                s = s + "\nYear: " + tax.getYear() + "\nTax Due: " + tax.getTax();
            }
        }
        return s;
    }

    public String balancingStatement(String eircode){
        /* Shows amount of tax paid for specific Property*/
        String s = "";
        s = "\nAll taxes for Property at " + eircode;
        for(int i = 0; i < properties.size(); i++) {
            if(properties.get(i).getEircode().equals(eircode)) {
                ArrayList<PropertyTax> history = properties.get(i).getTaxHistory();
                for (int y = 0; y < history.size(); y++){
                    PropertyTax tax = history.get(y);
                    if (tax.getPaid()){
                        s = s + "\nYear: " + tax.getYear() + "\nTax Paid: " + tax.getTax();
                    } else {
                        s = s + "\nYear: " + tax.getYear() + "\nTax Due: " + tax.getTax();
                    }
                }
            }
        }
        return s;
    }

    public String getPayments(){
        String row;
        String s = "";
        BufferedReader csvReader = null;
        for(int x = 0; x < properties.size(); x++) {
            String eircode = properties.get(x).getEircode();
            try {
                csvReader = new BufferedReader(new FileReader("record.csv"));
                while ((row = csvReader.readLine()) != null) {
                    String[] data = row.split(",");
                    for (int i = 0; i < data.length; i++) {
                        if (data[i].equals(eircode)) {
                            s = s + ("\n" + data[i] + "\nAmount: " + data[i + 1] + "\nYear of Registration: " + data[i + 2] + "\nYear Paid: " + data[i + 3] +"\n");
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
        return s;
    }

    public String getName() {
        return name;
    }
    public ArrayList<Property> getProperties() {
        return properties;
    }
}

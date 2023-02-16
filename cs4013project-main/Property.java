import java.util.ArrayList;
import java.util.Calendar;
public class Property
{
    /* Property info */
    private String address;
    private String eircode;
    private double marketValue;
    private String locationCategory;
    private boolean ppr;
    private int year;
    private ArrayList<PropertyTax> taxHistory;
    /* Tax/Payment History */
    public Property(String address, String eircode, double marketValue, String locationCategory, boolean ppr, int year){
        this.address = address;
        this.eircode = eircode;
        this.marketValue = marketValue;
        this.locationCategory = locationCategory;
        this.ppr = ppr;
        this.year = year;
    }
    public void createTaxHistory(){
        taxHistory = new ArrayList<PropertyTax>();
        int currentYear = Calendar.getInstance().get(Calendar.YEAR);
        for(int i = year; i <= currentYear; i++) {
            PropertyTax p = new PropertyTax(address, eircode, marketValue, locationCategory, ppr, year, i);
            taxHistory.add(p);
        }
    }
    public String toString(){
        String string = "\nAddress: " + address + "\nEircode: " + eircode + "\nMarket Value: " + marketValue + "\nLocation Category: " + locationCategory + "\nPrincipal Private Residence: " + ppr + "\nYear of Registration: " + year;
        return string;
    }
    public String getAddress(){
        return this.address;
    }
    public void setAddress(String address){
        this.address = address;
    }
    public String getEircode(){
        return this.eircode;
    }
    public void setEircode(String eircode){
        this.eircode = eircode;
    }
    public double getMarketValue(){
        return this.marketValue;
    }
    public void setMarketValue(double marketValue){
        this.marketValue = marketValue;
    }
    public String getLocationCategory(){
        return this.locationCategory;
    }
    public void setLocationCategory(String locationCategory){
        this.locationCategory = locationCategory;
    }
    public boolean getPpr(){
        return this.ppr;
    }
    public void setPpr(boolean ppr){
        this.ppr = ppr;
    }
    public int getYear(){
        return this.year;
    }
    public void setYear(int year){
        this.year = year;
    }
    public ArrayList<PropertyTax> getTaxHistory(){
        return this.taxHistory;
    }
}

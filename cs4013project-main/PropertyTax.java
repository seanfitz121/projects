import java.io.FileWriter;
import java.io.IOException;
import java.util.Calendar;
public class PropertyTax extends Property{
    private double tax;
    private boolean paid;
    private int year;
    private int regYear;
    private String address;
    private String eircode;
    private double marketValue;
    private String locationCategory;

    private boolean ppr;

    private double upperBand = 650000;
    private double upperBandPerc = .0004;
    private double middleBand = 400001;
    private double middleBandPerc = .0002;
    private double lowerBand = 150000;
    private double lowerBandPerc = .0001;

    private double penalty = 1.07;

    private double City = 100;
    private double LargeT = 80;
    private double SmallT = 60;
    private double Village = 50;
    private double Countryside = 25;

    private double pprVal = 100;

    public PropertyTax(String address, String eircode, double marketValue, String locationCategory, boolean ppr, int regYear, int year){
        super(address, eircode, marketValue, locationCategory, ppr, regYear);
        this.tax = getPropertyTax(address, eircode, marketValue, locationCategory, ppr, regYear, year);
        this.paid = false;
        this.year = year;
        this.regYear = regYear;
        this.address = address;
        this.eircode = eircode;
        this.marketValue = marketValue;
        this.locationCategory = locationCategory;
        this.ppr = ppr;
    }
    public double getPropertyTax(String address, String eircode, double marketValue, String locationCategory, boolean ppr, int regYear, int year){
        double tax = 100;
        double value = super.getMarketValue();
        if (value > this.upperBand) {
            tax = tax + (value*this.upperBandPerc);
        } else if (value > this.middleBand) {
            tax = tax + (value*this.middleBandPerc);
        } else if (value > this.lowerBand) {
            tax = tax + (value*this.lowerBandPerc);
        }
        tax = tax + getLocationTax(tax, locationCategory);
        tax = tax + isPrivateResidence(tax, ppr, this.pprVal);
        int currentYear = Calendar.getInstance().get(Calendar.YEAR);
        for(int i = year; i < currentYear; i++){
            tax = tax*penalty;
        }
        return tax;
    }
    public double getLocationTax(double tax, String locationCategory) {
        if (locationCategory.equals("City")){
            tax = tax + City;
        } else if (locationCategory.equals("Large town")){
            tax = tax + LargeT;
        } else if (locationCategory.equals("Small town")){
            tax = tax + SmallT;
        } else if (locationCategory.equals("Village")){
            tax = tax + Village;
        } else if (locationCategory.equals("Countryside")) {
            tax = tax + Countryside;
        }
        return tax;
    }
    public double isPrivateResidence(double tax, boolean ppr, double pprVal){
        if (!ppr){
            tax = tax + pprVal;
        }
        return tax;
    }
    public int getYear(){
        return this.year;
    }
    public double getTax(){
        return this.tax;
    }
    public void setPaid(){
        this.paid = true;
        try {
            FileWriter csvWriter = new FileWriter("record.csv", true);
            csvWriter.append(String.join("", super.getEircode(),","));
            csvWriter.append(String.join("", Double.toString(tax),","));
            csvWriter.append(String.join("", Integer.toString(regYear),","));
            csvWriter.append(String.join("", Integer.toString(year),","));
            csvWriter.append("\n");
            csvWriter.close();
        } catch (IOException e) {
            e.printStackTrace();
        }
    }
    public boolean getPaid(){
        return this.paid;
    }
    public double getUpperBand() {
        return upperBand;
    }

    public void setUpperBand(double upperBand) {
        this.upperBand = upperBand;
    }

    public double getMiddleBand() {
        return middleBand;
    }

    public void setMiddleBand(double middleBand) {
        this.middleBand = middleBand;
    }

    public double getLowerBand() {
        return lowerBand;
    }

    public void setLowerBand(double lowerBand) {
        this.lowerBand = lowerBand;
    }
    public double getUpperBandPerc() {
        return upperBandPerc;
    }

    public void setUpperBandPerc(double upperBandPerc) {
        this.upperBandPerc = upperBandPerc;
    }

    public double getMiddleBandPerc() {
        return middleBandPerc;
    }

    public void setMiddleBandPerc(double middleBandPerc) {
        this.middleBandPerc = middleBandPerc;
    }

    public double getLowerBandPerc() {
        return lowerBandPerc;
    }

    public void setLowerBandPerc(double lowerBandPerc) {
        this.lowerBandPerc = lowerBandPerc;
    }
    public double getPenalty() {
        return penalty;
    }
    public void setPenalty(double penalty) {
        this.penalty = penalty;
    }
    public double getCity() {
        return City;
    }

    public void setCity(double city) {
        City = city;
    }

    public double getLargeT() {
        return LargeT;
    }

    public void setLargeT(double largeT) {
        LargeT = largeT;
    }

    public double getSmallT() {
        return SmallT;
    }

    public void setSmallT(double smallT) {
        SmallT = smallT;
    }

    public double getVillage() {
        return Village;
    }

    public void setVillage(double village) {
        Village = village;
    }

    public double getCountryside() {
        return Countryside;
    }

    public void setCountryside(double countryside) {
        Countryside = countryside;
    }
    public double getPprVal() {
        return pprVal;
    }

    public void setPprVal(double pprVal) {
        this.pprVal = pprVal;
    }
    @Override
    public String getAddress() {
        return address;
    }

    @Override
    public void setAddress(String address) {
        this.address = address;
    }

    @Override
    public String getEircode() {
        return eircode;
    }

    @Override
    public void setEircode(String eircode) {
        this.eircode = eircode;
    }

    @Override
    public double getMarketValue() {
        return marketValue;
    }

    @Override
    public void setMarketValue(double marketValue) {
        this.marketValue = marketValue;
    }

    @Override
    public String getLocationCategory() {
        return locationCategory;
    }

    @Override
    public void setLocationCategory(String locationCategory) {
        this.locationCategory = locationCategory;
    }
    @Override
    public void setYear(int year) {
        this.year = year;
    }

    public int getRegYear() {
        return regYear;
    }

    public void setRegYear(int regYear) {
        this.regYear = regYear;
    }

    public boolean isPpr() {
        return ppr;
    }

    @Override
    public void setPpr(boolean ppr) {
        this.ppr = ppr;
    }
}

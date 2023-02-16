
public class TestOwner
{
    public TestOwner(){
    }
    public void testPassedOwner(Owner o){
        Property LK = new Property("19 Cul Crannagh", "V94WCV9", 1000, "City", true, 2018);
        Property L = new Property("1 Fedamore", "V94KL01", 500, "Village", true, 2015);
        //Property WE = new Property("18 Darrowton", "V94Y2VD", 2000, "Countryside", false, 2017);
        o.registerProperty(LK);
        o.registerProperty(L);
        //Sam.registerProperty(WE);
        o.viewProperties();
        o.viewPaidTax();
        o.payTax(LK, 2020);
        o.payTax(L, 2018);
        o.payTax(LK, 2018);
        o.viewPaidTax();
        o.viewDueTax();
        o.viewOverdueTax();
        o.balancingStatement(2020);
        o.balancingStatement(LK);
    }
}

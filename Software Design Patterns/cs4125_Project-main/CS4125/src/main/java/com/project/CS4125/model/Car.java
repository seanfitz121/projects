package com.project.CS4125.model;

import javax.persistence.*;

//Car Object
@Entity
public class Car {
    @Id
    @GeneratedValue(strategy = GenerationType.AUTO)
    @Column(name = "vehicle_id", nullable = false)
    private int vehicleID;
    private String name;
    private String BodyType;
    private float EngineSize;
    private String fuel;
    private int SeatCapacity;
    private boolean isRented;

    public Car() {}
    public Car(String Name){
        this.name = Name;
    }

    public Car(int ID){
        this.vehicleID = ID;
    }

    public int getVehicleID() {
        return vehicleID;
    }

    public void setVehicleID(int vehicleID) {
        this.vehicleID = vehicleID;
    }

    public String getName() {
        return name;
    }

    public void setName(String name) {
        this.name = name;
    }

    public String getBodyType() {
        return BodyType;
    }

    public void setBodyType(String bodyType) {
        BodyType = bodyType;
    }

    public float getEngineSize() {
        return EngineSize;
    }

    public void setEngineSize(float engineSize) {
        EngineSize = engineSize;
    }

    public String getFuel() {
        return fuel;
    }

    public void setFuel(String fuel) {
        this.fuel = fuel;
    }

    public int getSeatCapacity() {
        return SeatCapacity;
    }

    public void setSeatCapacity(int seatCapacity) {
        SeatCapacity = seatCapacity;
    }

    public boolean isRented() {
        return isRented;
    }

    public void setRented(boolean rented) {
        isRented = rented;
    }
}

package com.project.CS4125.model;

public interface Subject {
    //Subject interface
    public void attach(Observer o);
    public void detach();
    public void notifyUpdate(String v);
}

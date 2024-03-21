class CWin{
    private int x;
    private int y;
    private int z;
    private int r;
    private double pi=3.14;   

    void setLocation(int a,int b,int c){
        x = a;
        y = b;
        z = c;
    }

    void setRadius(int d){
        r = d;
    }

    double surfaceArea(){
        return 4 * pi * r * r;
    }

    double volume(){
        return (double)4/3*pi*r*r*r;
    }

    void showCenter(){
        System.out.printf("圓心座標：%d    %d    %d",x,y,z);
    }
}


public class Ch1_1 {
    public static void main(String args[]) {

        CWin obj = new CWin();
        obj.setLocation(3, 4, 5);

        obj.setRadius(1);

        System.out.printf("%f",obj.surfaceArea());

    }
}

import java.util.*;
class Solution{
	public static void main(String[] args){
		Scanner sc = new Scanner(System.in);
		int n = sc.nextInt();
		int[] arr = new int[n-1];
		int sum = 0;
		for(int i=0;i<n-1;i++){
			arr[i] = sc.nextInt();
			sum+=arr[i];
		}
		int act_sum = (int)((n*(n+1))/2);
		System.out.println("Missing number is : "+(act_sum - sum));
	}
}

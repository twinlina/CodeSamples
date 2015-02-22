/*
----------------------------------------------------------------------

File:  boolMatrix.cpp

This is the implementation file for the boolMatrix class.

Jessica Lewis
12/10/2014
CS 10
Assignment 11

CLASS INVARIANT: this class is a 2D array, a matrix, of size NUM_ROWS by NUM_COLS (in this case
	identified as global constants to be 20x20). 

----------------------------------------------------------------------
*/


#include <iostream>
#include <iomanip>
#include "boolMatrix.h"
using namespace std;



/*
Constructor Function
Purpose: Initializes the boolMatrix object to be a matrix full of false values (0's)
*/
boolMatrix::boolMatrix(){
	for (int row = 0; row < NUM_ROWS; row++){
        for (int col = 0; col < NUM_COLS; col++){
            matrix[row][col] = 0;
        }
    }
}






/* 
Member Function: get
Purpose: returns the current contents of a single array element. 
Uses arguments to indicate the row and column of the array element that should be returned. 
This function uses assert to exit the program if the row or column is out-of-bounds.
*/
bool boolMatrix::get(int row, int col) const
{
	assert (row < NUM_ROWS  && col < NUM_COLS); 
	
	return matrix[row][col];
}






/* 
Member Function: set
Purpose: sets the contents of a single array element. 
Uses arguments to indicate the row and column of the array element that should be set, and the value to
which it should be set. 
This function uses assert to exit the program if the row or column is out-of-bounds.
*/
void boolMatrix::set(int row, int col, bool value)
{
    assert (row < NUM_ROWS  && col < NUM_COLS); 
	
	matrix[row][col] = value;
}






/* 
Member Function: rowcount
Purpose: returns the number of true values that exist in any given row. 
This function uses assert to exit the program if the row is out-of-bounds.
*/
int boolMatrix::rowcount(int row, int NUM_COLS) const
{
	assert (row < NUM_ROWS); 
	
	int amount = 0;
	
	for(int count = 0; count < NUM_COLS; count ++){
		if(matrix[row][count] == 1){
			amount++;
		}
	}

	return amount;
}






/* 
Member Function: colcount
Purpose: returns the number of true values that exist in any given column. 
This function uses assert to exit the program if the row is out-of-bounds.
*/
int boolMatrix::colcount(int col, int NUM_ROWS) const
{

	assert (col < NUM_COLS); 
	
	int amount = 0;
	
	for(int count = 0; count < NUM_ROWS; count ++){
		if(matrix[count][col] == 1){
			amount++;
		}
	}

	return amount;
}






/* 
Member Function: totalcount
Purpose: returns the number of true values that exist in the entire array
*/
int boolMatrix::totalcount() const
{

	int amount = 0;
	
	for(int rowcount = 0; rowcount < NUM_ROWS; rowcount++){
		for(int colcount = 0; colcount < NUM_COLS; colcount++){
			if (matrix[rowcount][colcount] == 1){
				amount++;
			}
		}
	}

	return amount;
}






/* 
Member Function: print
Purpose: prints the matrix to the screen
*/
void boolMatrix::print() const
{
	cout << "  ";
	for (int col = 0; col < NUM_COLS; col++){
		cout << col % 10;
	}
	cout << endl;

    for (int rowcount = 0; rowcount < NUM_ROWS; rowcount++){
		
		if (rowcount < 10){
			cout << setw(2) << rowcount;
		}else if (rowcount >= 10 && rowcount < 100) {
			cout << setw(1) << rowcount;
		}
		for (int colcount = 0; colcount < NUM_COLS; colcount++){
            if (matrix[rowcount][colcount] == true){
				cout << "*";
			} else {
				cout << " ";
			}
        }
        cout << endl;
    }
}
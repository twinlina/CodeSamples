/* 
----------------------------------------------------------------------
File:  boolMatrix.h

This is the header file (interface file) for the boolMatrix class.

Jessica Lewis
12/10/2014
CS 10
Assignment 11

The boolMatrix class is used to store a 2D array with bool values.

boolMatrix();
    post: calling object has the value 0 - every element in the matrix is initialized with a 
		value of 'false'

bool boolMatrix::get(int row, int col) const;
	post: returns the current contents of a single array element, whose location is identified
		via the arguments

void boolMatrix::set(int row, int col, bool value);
	post: sets the value of a single array element, whose location is identified via arguments

int boolMatrix::rowcount(int row, int NUM_COLS) const;
	post: returns the number of true values in any given row by looping through each column in 
		a set row and checking for a value of 1

int boolMatrix::colcount(int col, int NUM_ROWS) const;
	post: returns the number of true values in any given column by looping through a set column
		in each row and checking for a value of 1

int boolMatrix::totalcount() const;
	post: returns the total number of true values in the array by looping through each element
		in each array and checking for a value of 1

void boolMatrix::print() const;
	post: prints the matrix by looping through the array and printing an asterisk for true values
		and a space for false values

----------------------------------------------------------------------
*/

#include <cassert>

#ifndef BOOLMATRIX_H
#define BOOLMATRIX_H

const int NUM_ROWS = 21;	// this is essentially the "outer" array
const int NUM_COLS = 22;	// this is essentially the "inner" array

class boolMatrix {
    public:
        boolMatrix();
		bool boolMatrix::get(int row, int col) const;
		void boolMatrix::set(int row, int col, bool value);
		int boolMatrix::rowcount(int row, int NUM_COLS) const;
		int boolMatrix::colcount(int col, int NUM_ROWS) const;
		int boolMatrix::totalcount() const;
		void boolMatrix::print() const;
    private:
        bool matrix[NUM_ROWS][NUM_COLS];
};


#endif

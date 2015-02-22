/*
----------------------------------------------------------------------

Jessica Lewis
12/10/2014
CS 10
Assignment 11

PROGRAM DESCRIPTION: This program will take a data file with organism locations and calculate each
	subsequent generation based on these rules:
		1. If the cell is currently empty:
			-If the cell has exactly three living neighbors, it will come to life in the next generation.
			-If the cell has any other number of living neighbors, it will remain empty.
		2. If the cell is currently living:
			-If the cell has one or zero living neighbors, it will die of loneliness in the next generation.
			-If the cell has four or more living neighbors, it will die of overcrowding in the next generation.
			-If the cell has two or three neighbors, it will remain living.
		3. All births and deaths occur simultaneously. This point is critical to the correct result.

----------------------------------------------------------------------
*/

#include <iostream>
#include <fstream>
#include "boolMatrix.h"
using namespace std;



void readData(boolMatrix &matrix);
void getInfo(int& numGens);
void iterate(boolMatrix& life, int row, int col, int numGens);
void nextGen(boolMatrix& life, int row, int col);
bool isAlive(const boolMatrix& life, int row, int col);
int countNeighbors(const boolMatrix& life, int row, int col);
bool onGrid(int row, int col);

int main()
{
	boolMatrix life;
	boolMatrix genX;
	int row = 0, col = 0, numGens;

	readData(life);

	getInfo(numGens);
	iterate(life,row,col,numGens);
	life.print();

	cout << "Total alive in row 10 = " << life.rowcount(10,NUM_COLS) << endl;
	cout << "Total alive in col 10 = " << life.colcount(10,NUM_ROWS) << endl;
	cout << "Total alive = " << life.totalcount() << endl;
}






/*
Function: readData 
Purpose: reads the data file and saves it to the boolMatrix object
*/
void readData(boolMatrix &matrix)
{
    ifstream datafile("genZero.dat");
    assert(datafile);
	int row, col;
    
    //initGen(matrix); DON'T NEED BECAUSE MATRIX IS ALREADY INITIALIZED FROM THE CLASS CONSTRUCTOR
    datafile >> row >> col;
    while (datafile) {
        matrix.set(row,col,true);
        datafile >> row >> col;
    }
    datafile.close();
}






/*
Function: getInfo 
Purpose: asks the user how many generations to calculate
*/
void getInfo(int& numGens)
{
	cout << "Enter number of generations: ";
	cin >> numGens;
	cout << endl;
}






/*
Function: iterate
Purpose: iterates the nextGen function the number of times specified by the user,
	saved in numGens
*/
void iterate(boolMatrix& life, int row, int col, int numGens)
{
	int count = 0;
	
	while(count < numGens){
		nextGen(life,row,col);
		count++;
	}
}






/*
Function: nextGen 
Purpose: loops through the current matrix, checks if each value is alive or dead, uses the 
	countNeighbors function to decide if it will be alive or dead in the next generation 
	and then save that value to the genX matrix. Once the new generation is created in genX,
	it is transferred to the life matrix and returned to main()
*/
void nextGen(boolMatrix& life, int row, int col)
{
	boolMatrix genX;
	
	for(int row = 0; row < NUM_ROWS; row++){
		for(int col = 0; col < NUM_COLS; col++){
			//if the current cell is alive
			if(isAlive(life, row, col)){
				//if the current cell has 0/1 or 4+ neighbors the cell dies
				if(countNeighbors(life, row, col) <= 1 || countNeighbors(life, row, col) >=4){
					genX.set(row,col, false);
				} else if(countNeighbors(life, row, col) == 2 || countNeighbors(life, row, col) == 3){ //if the current cell has 2 or 3 neighbors the cell lives
					genX.set(row,col, true);
				}
			} else if(!isAlive(life, row, col)){ //if the current cell is dead
				//if the current cell 
				if(countNeighbors(life, row, col) == 3){
					genX.set(row,col, true);
				} else {
					genX.set(row,col, false);
				}
			}
		}
	}

	life = genX;
	//return genX;

}






/*
Function: isAlive
Purpose: decides if the current element is alive or dead (bool true or false)
*/
bool isAlive(const boolMatrix& life, int row, int col)
{
	return life.get(row, col);
}






/*
Function: countNeighbors
Purpose: loops through the row above and below the current element, and the column before
	and after the element and counts how many true values there are, then subtracts one if
	the current cell is true (it doesn't know not to count itself)	
*/
int countNeighbors(const boolMatrix& life, int row, int col) {
    int count = 0;
    for (int rowCount = row-1; rowCount <= row+1; rowCount++){
        for (int colCount = col-1; colCount <= col+1; colCount++){
            if (onGrid(rowCount, colCount) && life.get(rowCount, colCount)){
                count++;
            }
        }
    }
	
    if (life.get(row, col)){	   //because we counted life[row][col] as a neighbor
        count--;
    }
	
    return count;
}






/*
Function: onGrid
Purpose: returns a true/false value based on whether or not the current element is
	on a valid row/col based on the beginning/end of the array and the NUM_ROWS and
	NUM_COLS values
*/
bool onGrid(int row, int col) {
    return row >= 0 && col >= 0 && row < NUM_ROWS && col < NUM_COLS;
}
/*
this is a simple checking code for general case (compare only)
*/

#include <cstdio>
#include <cstdlib>
#include <cstring>
#include <cmath>
#include <iostream>
#include <algorithm>
#include <set>
#include <map>
#include <vector>
#include <queue>
#include <stack>
#include <list>
#include <string>
#include <fstream>

using namespace std;

fstream input_file, key_file, ans_file;
string key, ans;

void correct(){
	cout << "$#1";
	exit(0);
}

void wrong(){
	cout << "$#0";
	exit(0);
}

void prepareData(){
	input_file.open("input_file");
	input_file >> key;
	input_file >> ans;
	key_file.open(key.c_str());
	ans_file.open(ans.c_str());
}

int main()
{
	prepareData();

	while(not key_file.eof() and not ans_file.eof())
	{
		//begin compare result of user's code and correct answer
		key_file >> key;
		ans_file >> ans;
		if(key != ans)
		{
			wrong();
		}
	}

	(key_file.eof() and ans_file.eof()) ? correct() : wrong();

	return 0;
}
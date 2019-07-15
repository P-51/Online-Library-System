# Online-Library-System
Website for A Online Library System
#define HELLO
#ifdef HELLO

#define _CRT_SECURE_NO_WARNINGS


#define MAX_STR_LEN 19
#define MAX_RECORDS 50000
#define MAX_FIELD 5
#define NULL 0


typedef enum
{
	NAME,
	NUMBER,
	BIRTHDAY,
	EMAIL,
	MEMO
} FIELD;

typedef struct
{
	int count;
	char str[20];
} RESULT;

typedef struct Node{
	struct Node* Nxt[MAX_FIELD];
	struct Node* Prv[MAX_FIELD];
	char str[MAX_FIELD][MAX_STR_LEN + 1];
}Record;


Record RecArray[MAX_RECORDS];
Record RecMemoryPool[MAX_RECORDS * 2];
int rCounter;

int hash(char *str)
{
	unsigned long hash = 5381;
	int c;

	while (c = *str++)
	{
		hash = (((hash << 5) + hash) + c) % MAX_RECORDS;
	}

	return hash % MAX_RECORDS;
}

int mstrcmp(char* s1, char* s2)
{
	while ((*s1 != '\0') && (*s1 == *s2))
	{
		s1++;
		s2++;
	}

	return (*s1 - *s2);
}

void mstrcpy(char dst[], char src[])
{
	int i = 0;
	while (src[i])
	{
		dst[i] = src[i];
		i++;
	}

	dst[i] = '\0';
}


void DeleteRecordInFieldLink(Record* record, int field)
{
	Record* tmp = record->Nxt[field];
	if (tmp)
		tmp->Prv[field] = record->Prv[field];

	tmp = record->Prv[field];
	if (tmp)
		tmp->Nxt[field] = record->Nxt[field];
}

void AddRecordInFieldLink(Record* record, int field)
{
	int hkey = hash(record->str[field]);
	Record* tmp = RecArray[hkey].Nxt[field];
	if (tmp != NULL)
		tmp->Prv[field] = record;

	record->Nxt[field] = tmp;
	record->Prv[field] = &RecArray[hkey];

	RecArray[hkey].Nxt[field] = record;
}

void InitDB()
{
	int i = 0;
	rCounter = 0;
	for (; i < MAX_RECORDS; i++)
	{
		int j = 0;
		for (; j < MAX_FIELD; j++)
		{
			RecArray[i].Nxt[j] = NULL;
			/*Record* rec = RecArray[i].Nxt[j];
			while (rec)
			{
			Record* nxt = rec->Nxt[j];
			int k = 0;
			for (; k < MAX_FIELD; k++)
			DeleteRecordInFieldLink(rec, k);

			delete rec;

			rec = nxt;
			}*/
		}
	}
}

void InitRecord(Record* rec)
{
	int i = 0;
	if (rec)
	{
		for (; i < MAX_FIELD; i++)
		{
			rec->str[i][0] = '\0';
			rec->Nxt[i] = NULL;
			rec->Prv[i] = NULL;
		}
	}
}

void Add(char* name, char* number, char* birthday, char* email, char* memo)
{
	//Record* rec = new Record;
	Record* rec = &RecMemoryPool[rCounter];
	rCounter++;
	InitRecord(rec);

	mstrcpy(rec->str[NAME], name);
	mstrcpy(rec->str[NUMBER], number);
	mstrcpy(rec->str[BIRTHDAY], birthday);
	mstrcpy(rec->str[EMAIL], email);
	mstrcpy(rec->str[MEMO], memo);

	int i = 0;
	for (; i < MAX_FIELD; i++)
		AddRecordInFieldLink(rec, i);

}

int Delete(FIELD field, char* str)
{
	int hkey = hash(str);
	Record* rec = RecArray[hkey].Nxt[field];
	int count = 0;

	while (rec)
	{
		Record* nxt = rec->Nxt[field];
		if (!mstrcmp(str, rec->str[field]))
		{
			count++;
			int i = 0;
			for (; i < MAX_FIELD; i++)
				DeleteRecordInFieldLink(rec, i);

			//delete rec;
		}
		rec = nxt;
	}
	return count;
}

int Change(FIELD field, char* str, FIELD changefield, char* changestr)
{
	int hkey = hash(str);
	Record* rec = RecArray[hkey].Nxt[field];
	int count = 0;

	while (rec)
	{
		Record* nxt = rec->Nxt[field];
		if (!mstrcmp(rec->str[field], str))
		{
			count++;
			DeleteRecordInFieldLink(rec, changefield);

			mstrcpy(rec->str[changefield], changestr);
			AddRecordInFieldLink(rec, changefield);
		}

		rec = nxt;
	}

	return count;
}

RESULT Search(FIELD field, char* str, FIELD returnfield)
{
	int hkey = hash(str);
	RESULT res;
	Record* rec = RecArray[hkey].Nxt[field];
	res.count = 0;

	while (rec)
	{
		Record* nxt = rec->Nxt[field];
		if (!mstrcmp(str, rec->str[field]))
		{
			res.count++;
			mstrcpy(res.str, rec->str[returnfield]);
		}
		rec = nxt;
	}

	return res;
}



#endif

//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
#define PRIME 25007
#define MAX_RECORDS 50001
#define PSIZE MAX_RECORDS*5

enum FIELD{ NAME, NUMBER, BDAY, EMAIL, MEMO, MAX_FIELD };

struct RESULT{
	int count;
	char str[20];
}res;

void mstrcpy(char *t, char *s){
	while (*t++ = *s++);
}

int mstrcmp(char *s1, char *s2){
	while (*s1 && (*s1 == *s2))
		s1++, s2++;
	return (*s1 - *s2);
}

struct lnode{
	int data;
	lnode *next;
}lpool[PSIZE];
int ldx = 0;

lnode* newlnode(int d){
	lpool[ldx].data = d;
	lpool[ldx].next = 0;
	return (&lpool[ldx++]);
}

struct Record{
	char data[MAX_FIELD][20];
	void init(char* name, char* number, char* birthday, char* email, char* memo){
		mstrcpy(data[NAME], name);
		mstrcpy(data[NUMBER], number);
		mstrcpy(data[BDAY], birthday);
		mstrcpy(data[EMAIL], email);
		mstrcpy(data[MEMO], memo);
	}
}record[MAX_RECORDS];
int rdx = 0;

class Hash{
	lnode *table[PRIME];
public:
	void init(){
		for (int i = 0; i < PRIME; i++)
			table[i] = 0;
	}

	unsigned int hash(char *s){
		unsigned int h = 5381;
		while (*s) 
			h = ((h << 5) + h + *s++) % PRIME;
		return h;
	}

	lnode * find(char *str){ return table[hash(str)]; }

	void insert(char *str, int rec_index){
		int h = hash(str);
		lnode *n = newlnode(rec_index);
		n->next = table[h];
		table[h] = n;
	}

	void remove(char *str, int rec_index){
		int h = hash(str);
		lnode *cur = table[h], *pre = 0;

		while (cur && cur->data != rec_index){
			pre = cur;
			cur = cur->next;
		}

		if (cur)
			(pre) ? pre->next = cur->next : table[h] = cur->next;
	}
}DB[MAX_FIELD];


void InitDB(){
	ldx = rdx = 0;
	for (int i = 0; i < MAX_FIELD; i++)
		DB[i].init();
}

void Add(char* name, char* number, char* birthday, char* email, char* memo){
	record[rdx].init(name, number, birthday, email, memo);
	for (int i = 0; i < MAX_FIELD; i++)
		DB[i].insert(record[rdx].data[i], rdx);
	rdx++;
}

RESULT Search(FIELD field, char* str, FIELD returnfield){
	res.count = 0;
	for (lnode *temp = DB[field].find(str); temp; temp = temp->next){
		int id = temp->data;
		if (0 == mstrcmp(str, record[id].data[field])){
			if (++res.count == 1)
				mstrcpy(res.str, record[id].data[returnfield]);
		}
	}
	return res;
}

int Delete(FIELD field, char* str){
	int count = 0;
	for (lnode *temp = DB[field].find(str); temp; temp = temp->next){
		int id = temp->data;
		if (0 == mstrcmp(str, record[id].data[field])){
			count++;
			for (int i = 0; i < MAX_FIELD; i++)
				DB[i].remove(record[id].data[i], id);
		}
	}
	return count;
}

int Change(FIELD field, char* str, FIELD changefield, char* changestr){
	int count = 0;
	for (lnode *temp = DB[field].find(str); temp; temp = temp->next){
		int id = temp->data;
		if (0 == mstrcmp(str, record[id].data[field])){
			count++;
			DB[changefield].remove(record[id].data[changefield], id);
			mstrcpy(record[id].data[changefield], changestr);
			DB[changefield].insert(changestr, id);
		}
	}
	return count;
}
////////////////////////////////////////////////////////////////////////////////////
#include <stdio.h>
#include <string.h>

typedef enum
{
	CMD_INIT,
	CMD_ADD,
	CMD_DELETE,
	CMD_CHANGE,
	CMD_SEARCH
} COMMAND;

typedef enum
{
	NAME,
	NUMBER,
	BIRTHDAY,
	EMAIL,
	MEMO
} FIELD;

typedef struct
{
	int count;
	char str[20];
} RESULT;

////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////

extern void InitDB();
extern void Add(char* name, char* number, char* birthday, char* email, char* memo);
extern int Delete(FIELD field, char* str);
extern int Change(FIELD field, char* str, FIELD changefield, char* changestr);
extern RESULT Search(FIELD field, char* str, FIELD returnfield);

////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////

static int dummy[100];
static int Score, ScoreIdx;
static char name[20], number[20], birthday[20], email[20], memo[20];

static char lastname[10][5] = { "kim", "lee", "park", "choi", "jung", "kang", "cho", "oh", "jang", "lim" };
static int lastname_length[10] = { 3, 3, 4, 4, 4, 4, 3, 2, 4, 3 };

static int mSeed;
static int mrand(int num)
{
	mSeed = mSeed * 1103515245 + 37209;
	if (mSeed < 0) mSeed *= -1;
	return ((mSeed >> 8) % num);
}

static void make_field(int seed)
{
	int name_length, email_length, memo_length;
	int idx, num;

	mSeed = (unsigned int)seed;

	name_length = 6 + mrand(10);
	email_length = 10 + mrand(10);
	memo_length = 5 + mrand(10);

	num = mrand(10);
	for (idx = 0; idx < lastname_length[num]; idx++) name[idx] = lastname[num][idx];
	for (; idx < name_length; idx++) name[idx] = 'a' + mrand(26);
	name[idx] = 0;

	for (idx = 0; idx < memo_length; idx++) memo[idx] = 'a' + mrand(26);
	memo[idx] = 0;

	for (idx = 0; idx < email_length - 6; idx++) email[idx] = 'a' + mrand(26);
	email[idx++] = '@';
	email[idx++] = 'a' + mrand(26);
	email[idx++] = '.';
	email[idx++] = 'c';
	email[idx++] = 'o';
	email[idx++] = 'm';
	email[idx] = 0;

	idx = 0;
	number[idx++] = '0';
	number[idx++] = '1';
	number[idx++] = '0';
	for (; idx < 11; idx++) number[idx] = '0' + mrand(10);
	number[idx] = 0;

	idx = 0;
	birthday[idx++] = '1';
	birthday[idx++] = '9';
	num = mrand(100);
	birthday[idx++] = '0' + num / 10;
	birthday[idx++] = '0' + num % 10;
	num = 1 + mrand(12);
	birthday[idx++] = '0' + num / 10;
	birthday[idx++] = '0' + num % 10;
	num = 1 + mrand(30);
	birthday[idx++] = '0' + num / 10;
	birthday[idx++] = '0' + num % 10;
	birthday[idx] = 0;
}

static void cmd_init()
{
	scanf("%d", &ScoreIdx);

	InitDB();
}

static void cmd_add()
{
	int seed;
	scanf("%d", &seed);

	make_field(seed);

	Add(name, number, birthday, email, memo);
}

static void cmd_delete()
{
	int field, check, result;
	char str[20];
	scanf("%d %s %d", &field, str, &check);

	result = Delete((FIELD)field, str);
	if (result != check)
		Score -= ScoreIdx;
}

static void cmd_change()
{
	int field, changefield, check, result;
	char str[20], changestr[20];
	scanf("%d %s %d %s %d", &field, str, &changefield, changestr, &check);

	result = Change((FIELD)field, str, (FIELD)changefield, changestr);
	if (result != check)
		Score -= ScoreIdx;
}

static void cmd_search()
{
	int field, returnfield, check;
	char str[20], checkstr[20];
	scanf("%d %s %d %s %d", &field, str, &returnfield, checkstr, &check);

	RESULT result = Search((FIELD)field, str, (FIELD)returnfield);

	if (result.count != check || (result.count == 1 && (strcmp(checkstr, result.str) != 0)))
		Score -= ScoreIdx;
}

static void run()
{
	int N;
	scanf("%d", &N);
	for (int i = 0; i < N; i++)
	{
		int cmd;
		scanf("%d", &cmd);
		switch (cmd)
		{
		case CMD_INIT:   cmd_init();   break;
		case CMD_ADD:    cmd_add();    break;
		case CMD_DELETE: cmd_delete(); break;
		case CMD_CHANGE: cmd_change(); break;
		case CMD_SEARCH: cmd_search(); break;
		default: break;
		}
	}
}

static void init()
{
	Score = 1000;
	ScoreIdx = 1;
}

int main()
{
	setbuf(stdout, NULL);
	//freopen("sample_input.txt", "r", stdin);

	int T;
	scanf("%d", &T);

	int TotalScore = 0;
	for (int tc = 1; tc <= T; tc++)
	{
		init();

		run();

		if (Score < 0)
			Score = 0;

		TotalScore += Score;
		printf("#%d %d\n", tc, Score);
	}
	printf("TotalScore = %d\n", TotalScore);

	return 0;
}
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
import java.util.Scanner;

interface Field 
{
	public final static int NAME     = 0;
	public final static int NUMBER   = 1;
	public final static int BIRTHDAY = 2;
	public final static int EMAIL    = 3;
	public final static int MEMO     = 4;
}

class Solution 
{
	private final static int CMD_INIT   = 0;
	private final static int CMD_ADD    = 1;
	private final static int CMD_DELETE = 2;
	private final static int CMD_CHANGE = 3;
	private final static int CMD_SEARCH = 4;
	
	static class Result
	{
        public int count;                                
        public String str;
	}
	
	private static Scanner sc;
	private static UserSolution userSolution = new UserSolution();

	private static int Score;
	private static int ScoreIdx;
	private static String name, number, birthday, email, memo;

	private static String lastname[] = { "kim", "lee", "park", "choi", "jung", "kang", "cho", "oh", "jang", "lim" };
	private static int lastname_length[] = { 3, 3, 4, 4, 4, 4, 3, 2, 4, 3 };

	private static int mSeed;
	private static int mrand(int num)
	{
		mSeed = mSeed * 1103515245 + 37209;
		if (mSeed < 0) mSeed *= -1;
		return ((mSeed >> 8) % num);
	}

	private static void make_field(int seed)
	{
		StringBuilder sbname = new StringBuilder();
		StringBuilder sbnumber = new StringBuilder();
		StringBuilder sbbirthday = new StringBuilder();
		StringBuilder sbemail = new StringBuilder();
		StringBuilder sbmemo = new StringBuilder();

		int name_length, email_length, memo_length;
		int num;

		mSeed = seed;

		name_length = 6 + mrand(10);
		email_length = 10 + mrand(10);
		memo_length = 5 + mrand(10);		

		num = mrand(10);
		sbname.append(lastname[num]);
		for (int i = 0; i < name_length - lastname_length[num]; i++) sbname.append((char)('a' + mrand(26)));

		for (int i = 0; i < memo_length; i++) sbmemo.append((char)('a' + mrand(26)));

		for (int i = 0; i < email_length - 6; i++) sbemail.append((char)('a' + mrand(26)));
		sbemail.append("@");
		sbemail.append((char)('a' + mrand(26)));
		sbemail.append(".com");

		sbnumber.append("010");
		for (int i = 0; i < 8; i++) sbnumber.append((char)('0' + mrand(10)));

		sbbirthday.append("19");
		num = mrand(100);
		sbbirthday.append((char)('0' + num / 10));
		sbbirthday.append((char)('0' + num % 10));
		num = 1 + mrand(12);
		sbbirthday.append((char)('0' + num / 10));
		sbbirthday.append((char)('0' + num % 10));
		num = 1 + mrand(30);
		sbbirthday.append((char)('0' + num / 10));
		sbbirthday.append((char)('0' + num % 10));
		
		name = sbname.toString();
		number = sbnumber.toString();
		birthday = sbbirthday.toString();
		email = sbemail.toString();
		memo = sbmemo.toString();
	}

	private static void cmd_init()
	{
		ScoreIdx = Integer.parseInt(sc.next());

		userSolution.InitDB();
	}

	private static void cmd_add()
	{
		int seed = Integer.parseInt(sc.next());

		make_field(seed);

		userSolution.Add(name, number, birthday, email, memo);
	}

	private static void cmd_delete()
	{
		int field = Integer.parseInt(sc.next());
		String str = sc.next();
		int check = Integer.parseInt(sc.next());
		
		int result = userSolution.Delete(field, str);
		if (result != check)
			Score -= ScoreIdx;
	}

	private static void cmd_change()
	{
		int field = Integer.parseInt(sc.next());
		String str = sc.next();
		int changefield = Integer.parseInt(sc.next());
		String changestr = sc.next();
		int check = Integer.parseInt(sc.next());

		int result = userSolution.Change(field, str, changefield, changestr);
		if (result != check)
			Score -= ScoreIdx;
	}

	private static void cmd_search()
	{
		int field = Integer.parseInt(sc.next());
		String str = sc.next();
		int returnfield = Integer.parseInt(sc.next());
		String checkstr = sc.next();
		int check = Integer.parseInt(sc.next());
		
		Result result = userSolution.Search(field, str, returnfield);
		if (result.count != check || (result.count == 1 && !checkstr.equals(result.str)))
			Score -= ScoreIdx;
	}

	private static void run()
	{
		int N = Integer.parseInt(sc.next());
		for (int i = 0; i < N; i++)
		{
			int cmd = Integer.parseInt(sc.next());
			switch (cmd)
			{
			case CMD_INIT:   cmd_init(); break;
			case CMD_ADD:    cmd_add(); break;
			case CMD_DELETE: cmd_delete(); break;
			case CMD_CHANGE: cmd_change(); break;
			case CMD_SEARCH: cmd_search(); break;
			default: break;
			}
		}
	}
	
	private static void init()
	{
		Score = 1000;
		ScoreIdx = 1;
	}	
	
	public static void main(String[] args) throws Exception
	{
		//System.setIn(new java.io.FileInputStream("res/sample_input.txt"));
		
		sc = new Scanner(System.in);

		int T = sc.nextInt();
		int TotalScore = 0;	
		for (int tc = 1; tc <= T; tc++)
		{
			init();
			
			run();
			
			if (Score < 0)
				Score = 0;

			TotalScore += Score;

			System.out.println("#" + tc + " " + Score);
		}
		System.out.println("TotalScore = " + TotalScore);
		sc.close();
	}
}

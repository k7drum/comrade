class boss:

    num_of_emps = 0
    raise_amt = 1.04

    def __init__(self, first, last, pay):
        self.first = first
        self.last = last
        self.email = first + '.' + last + '@email.com'
        self.pay = pay

        boss.num_of_emps += 1

    def fullname(self):
        return '{} {}'.format(self.first, self.last)

    def apply_raise(self):
        self.pay = int(self.pay * self.raise_amt)

    @classmethod
    def set_raise_amt(cls, amount):
        cls.raise_amt = amount

    @classmethod
    def from_string(cls, emp_str):
        first, last, pay = emp_str.split('-')
        return cls(first, last, pay)

    @staticmethod
    def is_workday(day):
        if day.weekday() == 5 or day.weekday() == 6:
            return False
        return True


emp_1 = boss('Corey', 'Schafer', 50000)
emp_2 = boss('Test', 'boss', 60000)

boss.set_raise_amt(1.05)

print(boss.raise_amt)
print(emp_1.raise_amt)
print(emp_2.raise_amt)

boss_1 = 'John-Doe-70000'
boss_2 = 'Steve-Smith-30000'
boss_3 = 'Jane-Doe-90000'

first, last, pay = boss_1.split('-')

#boss_1 = boss(first, last, pay)
new_emp_1 = boss.from_string(boss_1)

print(new_emp_1.email)
print(new_emp_1.pay)

import datetime
my_date = datetime.date(2016, 7, 11)

print(boss.is_workday(my_date))

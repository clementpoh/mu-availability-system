# cleaner.ph
# Clement Poh
#
# This file downloads the audit trail and removes occurences of duplicate Ip
# Addresses and saves the data into a file called output.csv
#
import csv
from datetime import datetime
from urllib import urlopen

output = 'output.csv'
file = csv.DictReader(urlopen('http://audittrail.its.unimelb.edu.au/api/status?key=1R5bA3Gz9G2kAk2g8A0Poz3zk4QlnMz9r6kp', 'rb'))


list1 = {}
for c in file:
    c['IP'] = c['IP'][2:-1]
    updated = datetime.strptime(c['Updated'][2:-3], '%Y-%m-%d %H:%M:%S') 
    if c['IP'] in list1:
        if updated > list1[c['IP']][1]:
            list1[c['IP']] = [c['Computer name'], updated]
        else:
            continue
    else:
        list1[c['IP']] = [c['Computer name'], updated]

print len(list1)

writer = csv.writer(open(output, 'wb'))

for (k, v) in list1.items():
    writer.writerow([k, v[0], v[1]])

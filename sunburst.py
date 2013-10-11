import sys
import math

args = sys.argv;

if len(args) >= 2 and args[1] == "-h":
    print("\n\nVector Sunburst Generator - Digital Phantom\n\n"
          "\tUsage:\n\t%s [file] [sides] [radius]\n\n"
          "\t[file] - file name where SVG file will be saved\n"
          "\t[sides] - the number of rays the sunburst will have\n"
          "\t[radius] - radius of the sunburst\n\n"
          "(c) 2013 Digital Phantom - http://www.digitalphantom.net/\n"
          "authored by: Yoel Nunez http://www.yoelnunez.com/" % args[0])
    exit()
elif len(args) < 4:
    print("\nERROR: Please type %s -h for help\n\n" % args[0])
    exit()

filename = args[1]
sides = int(args[2])
radius = int(args[3])

if str == "":
    print("\nERROR: filename cannot be empty, please refer to the usage details for instructons\n\n")
    exit()
elif sides == 0:
    print("\nERROR: the number of sides \"%d\" has to be an integer > 0\n\n" % sides)
    exit()
elif radius == 0:
    radius = 50

points = 5 * sides

angle = 360 / points

coordinates = ""

for i in range(points):
    ix = math.sin(math.radians(i * angle)) * radius
    iy = math.cos(math.radians(i * angle)) * - 1 * radius

    x = radius + ix
    y = radius + iy

    if i % 5 == 0:
        x = y = radius

    coordinates += str(x) + "," + str(y) + " "

try:
    handle = open(filename, "w+")

    handle.write('<svg xmlns="http://www.w3.org/2000/svg" version="1.1">')
    handle.write('<polygon points="' + coordinates + '" style="fill:#000;"/>')
    handle.write('</svg>')

    print("\nYour vector file \"%s\" was successfully generated.\n\n" % filename)

except IOError:
    print("\nERROR: The file \"%s\" could not be opened.\n\n" % filename);
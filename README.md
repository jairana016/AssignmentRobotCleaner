# CodingAssignment
User Story:
  As a user, I want a robot to clean my 2 apartments.The first apartment has a 70 m2 hard floor.The second apartment has a 60 m2
  carpeted floor. The robot should charge its battery itself once it runs out of energy.

  I want to run a command $ robot.php clean --floor=carpet --area=70 and I want to see the state output while it's cleaning or charging the
  battery. The --floor parameter should accept either hard or carpet to determine how the robot should behave based on the following
  assumptions.
  
Assumptions 
  ● The robot has a battery big enough to clean for 60 seconds in one charge.
  ● The robot can clean 1 m2 of hard floor in 1 second.
  ● The robot can clean 1 m2 of carpet in 2 seconds.
  ● The battery charge from 0 to 100% takes 30 seconds.
    

To Run the assignment following are the prerequisites:
  ● PHP 7.x version.
  ● PHPUnit version 6.5 and above. (Refer - https://phpunit.de/getting-started/phpunit-7.html)

  After the configuration mentioned above.

  Clone the git directory to your local machine, Open command prompt on your local machine get into the directory and execute the
  following commands one by one:
   ● To clean the apartment of specific floor type and specific floor area by Robot execute below commands
    ● php robot.php clean --floor=carpet --area=60
    ● php robot.php clean --floor=hard --area=70
    
    Note: If there is any change in the command i.e. floor type is other than 'carpet' or 'hard' and if area is not numeric then,
    you will get an error on the command line.

  ● To Test it with PHPUnit, we have written few test classes. So to execute them in the same command line you can execute the commands:
    ● phpunit Test/CarpetFloorApartmentTest.php
    ● phpunit Test/HardFloorApartmentTest.php
    ● phpunit Test/RobotFloorCleanerTest.php


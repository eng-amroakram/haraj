<?php

return [
    "cars-models" => "required|in:Abarth,Acura,Alfa Romeo,Ariel,Aston Martin,Audi,BAC,BAIC,Bentley,BMW,Besturn,Bizzarrini,Borgward,Brilliance,Bugatti,Buick,BYD,Cadillac,Can-am,Caterham,Changan,CEVO,Chery,Chevrolet,Chrysler,Citroen,CMC,Coda,Daewoo,Daihatsu,Datsun,DeLorean,DFSK,Dodge,Dongfeng,Donkervoort,Dorcen,Dquus,FAW,Fenyr,Ferrari,Fiat,Fisker,Force,Ford,Foton,GAC,GAC Gonow,Geely,Genesis,GMC,Grand Tiger,Great Wall,Gumpert,Haval,HiPhi,Honda,Hongqi,Huanghai,Hummer,Hyundai,Infiniti,Isuzu,JAC,Jaguar,Jeep,Jinbei,JMC,Lveco,Kandi,Karma,Kia,Koenigsegg,KTM,Lada,Lamborghini,Lancia,Land Rover,Landwind,Lexus,Liebao,Lifan,Lincoln,Levc,Lotus,Luxgen,Mahindra,Maserati,Maxus,Maybach,Mazda,McLaren,Mercedes-Benz,Mercury,MG,MG Motor,Milan,Mini,Mitsubishi,Morgan,Morris Garages,NIO,Nissan,Noble,Opel,Oullim,Pagani,PAL-V,Peugeot,Polestar,Pontiac,Porsche,Proton,Puch,Qoros,Qvale,Ram,Ravon,Renault,Renault Samsung,SAIC,Saipa,Saleen,Saturn,Scion,Seat,Shuanghuan,Skoda,Smart,Soueast,Speranza,Spyker,SsangYong,Subaru,Suzuki,Tata,Tazzari,Tesla,Tianma,Tianye,Toyota,Tramontana,Triumph,Vauxhall,Volkswagen,Volvo,Wallyscar,W Motors,Wartburg,Wey,Wiesmann,Xpeng,Zotye,ZX Auto,Zenvo",
    "years" => "required|in:2000,2001,2002,2003,2004,2005,2006,2007,2008,2009,2010,2011,2012,2013,2014,2015,2016,2017,2018,2019,2020,2021,2022",
    "regional-specifications" => "required|in:Gulf Specifications,American Specifications,Canadian Specifications,European Specifications,Japanese Specifications,Korean Specifications,Other Specifications",
    "fuel-types" => "required|in:Petrol,Diesel,Generator,Electric,Other",
    "driving-hand" => ["required", "in:Left Hand,Right Hand"],
    "car-conditions" => "required|in:Excellent inside and out,No accidents with very minor defects,Little damage,all repaired,Normal damage and cracks,with some imperfections,A lot of spoilage and obvious damage to the body",
    "insurances" => "required|in:Yes,No,Not Applicable",
    "mechanical-conditions" => "required",
    "engine-powers" => "required|in:0 - 200 HP,200 - 300 HP,300 - 400 HP,400 - 500 HP,500 - 600 HP,600 - 700 HP,700 - 800 HP,800 - 900 HP,900 - 1000 HP,More than 1000 HP,Not Known",
    "cylinders" => "required|in:3 Cylinders,4 Cylinders,5 Cylinders,6 Cylinders,8 Cylinders,10 Cylinders,12 Cylinders,16 Cylinders,Not Known",
    "body-types" => "required|in:Four Wheel Drive,Coupe,Sedan,Crossover,Convertible Hardtop Car,Truck,Hatchback,Convertible Soft Top Car,Sports Car,Pickup Truck/van,Wagon,Utility Truck,Other",
    "transmissions-types" => "required|in:Automatic,Manual,Not Known",
    "colors" => "required|in:Black,Blue,Brown,Burgundy,Gold,Grey,Green,Light Green,Orange,Pink,Purple,Red,Silver,White,Yellow,Other",
    "additional-features" => "required",
    "seller-types" => "required|in:Owner,Dealership,Individual,Auction,Rental,Bank,Company,Government,Other",
    "doors-number" => "required|in:2 Doors,3 Doors,4 Doors,5 Doors,6 Doors",
    "seats-number" => "required|in:2 Seats,4 Seats,5 Seats,6 Seats,7 Seats,8 Seats,+8 Seats",
    "technical-features" => "required"
];
// DVD Player
// "required|in:Climate Control,Cooled Seats,DVD Player,Front Drag,Keyless Entry,Leather Seats,Navigation System,Parking Sensors,Excellent Sound System,Reversible Camera"
// |in:Excellent inside and out,Minor faults,all fixed,Major faults,all fixed,Major bugs,most of them fixed and only a few left,Constant minor and major mechanical failures,Not working

## Bouquet Factory
This CLI app produces bouquets of flowers from input received.

#### Input format
```
<bouquet design 1>
<bouquet design 2>
...
<blank line>
<flower 1>
<flower 2>
...
```

#### Output
```
<bouquet 1>
<bouquet 2>
...
All requested bouquets have been delivered. Time to go home!!!
```
#### Full Specifications
- A *flower specie* is identified by a single, lowercase letter: a - z;
- A *flower size* is indicated by a single, uppercase letter: L (large) and S (small).
- A *flower* is identified by a *flower specie* and a *flower size*: for example, rL.
- A *bouquet name* is indicated by a single, uppercase letter: A - Z;
- A *bouquet size* is indicated by a single, uppercase letter: L (large) and S (small).
- A *bouquet design* is single line of characters with the following format:
```
<bouquet name><bouquet size><flower 1 quantity><flower 1 specie>...<flower N quantity><flower N specie><total quantity of flowers in the bouquet>
```
Example: AL8d10r5t30
- A *bouquet* is single line of characters with the following format:
```
<bouquet name><bouquet size><flower 1 quantity><flower 1 specie>...<flower N quantity><flower N specie>
```
Example: AL8d10r5t7z
- The *bouquet design* and *bouquet* formats includes a *bouquet size* but no *flower sizes*. This is because large *bouquets* are only made
from large *flowers*, and small *bouquets* are only made from small *flowers*.
- The *flower species* are listed in alphabetic order and only appear once in both *bouquet designs* and *bouquets*.
- The *flower quantities* are always larger than 0 for both *bouquet designs* and *bouquets*.
- The *total quantity* of flowers in the *bouquet* for *bouquet design* can be bigger than the sum of the *flower quantities*, allowing extra
space in the *bouquets* that can consist of any kind of *flowers*.
- The *bouquet* does not have *total quantity* of flowers in the *bouquet* specified, but the sum of the *flower quantities* should be equal to
the *total quantity* of *flowers* in the *bouquet* of the corresponding *bouquet design*.

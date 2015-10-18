//
//  MainViewController.m
//  Groceries
//
//  Created by Martin Isaza on 10/17/15.
//  Copyright © 2015 Martin Isaza. All rights reserved.
//

#import "MainViewController.h"
#import "ItemSearch.h"
#import "Results.h"
#import "GroceryCollectionViewCell.h"
#import "UIImageView+AFNetworking.h"
#import "Enlarge.h"
#import "LocationController.h"

@interface MainViewController () <UISearchBarDelegate, UICollectionViewDelegate, UICollectionViewDataSource>

@end

@implementation MainViewController

NSArray *dataArray;
static NSString * const reuseIdentifier = @"GroceryItem";


- (void)viewDidLoad {
    [super viewDidLoad];
    // Do any additional setup after loading the view.
    [LocationController sharedController];
    
    LocationController *locationController = [[LocationController alloc]init];
    NSLog(@"Geo Coordinates: %f, %f", locationController.locationManager.location.coordinate.latitude, locationController.locationManager.location.coordinate.longitude);
    
    [self.itemSearchBar setDelegate:self];
    [self.itemSearchBar becomeFirstResponder];
    
    [self.resultsCollectionView setDelegate:self];
    [self.resultsCollectionView setDataSource:self];
    self.itemSearchBar.placeholder = @"What are you looking for?";
    
//    [self.resultsCollectionView registerClass:[GroceryCollectionViewCell class] forCellWithReuseIdentifier:reuseIdentifier];
    
    [self.resultsCollectionView reloadData];
}

- (void)didReceiveMemoryWarning {
    [super didReceiveMemoryWarning];
    // Dispose of any resources that can be recreated.
}

//Search bar delegate methods
- (void)searchBarSearchButtonClicked:(UISearchBar *)searchBar {
    //dismiss keyboard
    [searchBar resignFirstResponder];

    //query server for results in
    ItemSearch *itemSearchController = [[ItemSearch alloc] init];
    
    //activity indeicator
    [self.groceriesActivityIndicator startAnimating];
    
    [itemSearchController postForGroceriesOnProduct:self.itemSearchBar.text andCompletion:^(NSArray *returnedArray, NSError *Error) {
        
        dispatch_async(dispatch_get_main_queue(), ^{
            if (Error) {
                //do something
            }
            
            else {
                dataArray = [returnedArray mutableCopy];
                [self.resultsCollectionView reloadData];
            }
            [self.groceriesActivityIndicator stopAnimating];
        });

    }];
}

- (NSInteger)collectionView:(UICollectionView *)collectionView numberOfItemsInSection:(NSInteger)section
{
    return dataArray.count;
}

// The cell that is returned must be retrieved from a call to -dequeueReusableCellWithReuseIdentifier:forIndexPath:
- (UICollectionViewCell *)collectionView:(UICollectionView *)collectionView cellForItemAtIndexPath:(NSIndexPath *)indexPath {
   
    GroceryCollectionViewCell *itemCell = (GroceryCollectionViewCell*)[collectionView dequeueReusableCellWithReuseIdentifier:reuseIdentifier forIndexPath:indexPath];
    NSLog(@"%@", dataArray);
    NSLog(@"PRICE: %@", dataArray[indexPath.row][@"price"]);
    NSString *priceString = [NSString stringWithFormat:@"$%@", dataArray[indexPath.row][@"price"]];
    [itemCell.priceLabel setText: priceString];
    
    NSString *imageUrl = [NSString stringWithFormat:@"%@", dataArray[indexPath.row][@"URL"]];
    
    if (dataArray[indexPath.row][@"URL"]) {
        UIImage *image = [UIImage imageWithData:[NSData dataWithContentsOfURL:[NSURL URLWithString:imageUrl]]];
        itemCell.productPhoto.image = image;
        itemCell.productPhoto.contentMode = UIViewContentModeScaleAspectFit;
    }
    
    return itemCell;

}

- (void)collectionView:(UICollectionView *)collectionView didSelectItemAtIndexPath:(NSIndexPath *)indexPath {
    
    GroceryCollectionViewCell *cvCell = [self.resultsCollectionView cellForItemAtIndexPath:indexPath];
    NSMutableDictionary *enlargeDict = [[NSMutableDictionary alloc] initWithDictionary:dataArray[indexPath.row]];
    enlargeDict[@"Image"] = cvCell.productPhoto.image;
    
    Enlarge *enlargeController = [[Enlarge alloc] init];
    [enlargeController setUpEnlargeViewWithDictionary:enlargeDict];
}

/*
#pragma mark - Navigation

// In a storyboard-based application, you will often want to do a little preparation before navigation
- (void)prepareForSegue:(UIStoryboardSegue *)segue sender:(id)sender {
    // Get the new view controller using [segue destinationViewController].
    // Pass the selected object to the new view controller.
}
*/

@end

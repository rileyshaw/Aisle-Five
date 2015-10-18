//
//  MainViewController.h
//  Groceries
//
//  Created by Martin Isaza on 10/17/15.
//  Copyright © 2015 Martin Isaza. All rights reserved.
//

#import <UIKit/UIKit.h>

@interface MainViewController : UIViewController
@property (weak, nonatomic) IBOutlet UIActivityIndicatorView *groceriesActivityIndicator;

@property (weak, nonatomic) IBOutlet UISearchBar *itemSearchBar;
@property (weak, nonatomic) IBOutlet UICollectionView *resultsCollectionView;
@property (weak, nonatomic) IBOutlet UIImageView *itemImage;

- (void)searchBarSearchButtonClicked:(UISearchBar *)searchBar;
- (NSInteger)collectionView:(UICollectionView *)collectionView numberOfItemsInSection:(NSInteger)section;

- (UICollectionViewCell *)collectionView:(UICollectionView *)collectionView cellForItemAtIndexPath:(NSIndexPath *)indexPath;


@end

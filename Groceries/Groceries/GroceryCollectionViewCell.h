//
//  GroceryCollectionViewCell.h
//  Groceries
//
//  Created by Martin Isaza on 10/17/15.
//  Copyright © 2015 Martin Isaza. All rights reserved.
//

#import <UIKit/UIKit.h>

@interface GroceryCollectionViewCell : UICollectionViewCell
@property (weak, nonatomic) IBOutlet UILabel *priceLabel;
@property (weak, nonatomic) IBOutlet UIImageView *productPhoto;

@end

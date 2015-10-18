//
//  ItemSearch.h
//  Groceries
//
//  Created by Martin Isaza on 10/17/15.
//  Copyright © 2015 Martin Isaza. All rights reserved.
//

#import <Foundation/Foundation.h>

@interface ItemSearch : NSObject

- (void)getItemsFromSearch:(NSString *)searchText withCallback: (void (^) (NSMutableArray *results)) completion;
- (void)postForGroceriesOnProduct:(NSString *)productName andCompletion:(void (^) (NSArray *returnedArray, NSError *Error))completionHandler;

@end

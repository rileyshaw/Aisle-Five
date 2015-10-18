//
//  LocationController.h
//  Groceries
//
//  Created by Martin Isaza on 10/17/15.
//  Copyright © 2015 Martin Isaza. All rights reserved.
//

#import <Foundation/Foundation.h>
#import <CoreLocation/CoreLocation.h>

@interface LocationController : NSObject<CLLocationManagerDelegate>

@property (strong, nonatomic) CLLocationManager *locationManager;
@property (strong, nonatomic) CLLocation *currentLocation;

+ (instancetype)sharedController;
- (void)updateUserLocation;
- (instancetype)init;
- (void)getNameFromLocation: (CLLocation *)locationParam isNear: (BOOL)isNear AndCompletion:(void (^)(NSString *locationName))callBack;

@end

//
//  Enlarge.m
//  Groceries
//
//  Created by Martin Isaza on 10/17/15.
//  Copyright © 2015 Martin Isaza. All rights reserved.
//

#import "Enlarge.h"

@interface Enlarge ()

@end

@implementation Enlarge
NSDictionary *paramDict;

- (void)viewDidLoad {
    [super viewDidLoad];
    // Do any additional setup after loading the view.
    
    self.priceEnlargeLabel.text = [NSString stringWithFormat:@"$%@ at %@", paramDict[@"price"], paramDict[@"storeName"]];
    
    self.enlargeImageView.image = paramDict[@"Image"];
    self.enlargeImageView.contentMode = UIViewContentModeScaleAspectFit;
    self.longTextView.text = paramDict[@"name"];
}

- (void)setUpEnlargeViewWithDictionary:(NSDictionary *)dict {
    paramDict = dict;
}

- (void)didReceiveMemoryWarning {
    [super didReceiveMemoryWarning];
    // Dispose of any resources that can be recreated.
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
